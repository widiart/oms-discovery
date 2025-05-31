<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::create(2025, 5, 25);
        $startOfCurrentMonth = $now->copy()->startOfMonth();
        $endOfCurrentMonth = $now->copy()->endOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();
        
        // Total customers
        $totalCustomerLast = Customer::where('created_at', '<=', $endOfLastMonth)->count();
        $totalCustomerCurrent = Customer::where('created_at', '<=' ,$endOfCurrentMonth)->count();

        // Active customers (with transaction)
        $activeCustomerLast = Customer::whereHas('orders', function ($q) use ($startOfLastMonth, $endOfLastMonth) {
            $q->whereBetween('order_date', [$startOfLastMonth, $endOfLastMonth]);
        })->count();

        $activeCustomerCurrent = Customer::whereHas('orders', function ($q) use ($startOfCurrentMonth, $endOfCurrentMonth) {
            $q->whereBetween('order_date', [$startOfCurrentMonth, $endOfCurrentMonth]);
        })->count();

        // Total sales
        $totalSalesLast = Order::whereBetween('order_date', [$startOfLastMonth, $endOfLastMonth])->sum('total_price');
        $totalSalesCurrent = Order::whereBetween('order_date', [$startOfCurrentMonth, $endOfCurrentMonth])->sum('total_price');

        // Total orders
        $totalOrderLast = Order::whereBetween('order_date', [$startOfLastMonth, $endOfLastMonth])->count();
        $totalOrderCurrent = Order::whereBetween('order_date', [$startOfCurrentMonth, $endOfCurrentMonth])->count();

        return response()->json([
            'success' => true,
            'message' => 'Summary retrive successfully',
            'data' => [
                'customer' => [
                    'last' => $totalCustomerLast,
                    'current' => $totalCustomerCurrent,
                ],
                'active' => [
                    'last' => $activeCustomerLast,
                    'current' => $activeCustomerCurrent,
                ],
                'sales' => [
                    'last' => $totalSalesLast,
                    'current' => $totalSalesCurrent,
                ],
                'order' => [
                    'last' => $totalOrderLast,
                    'current' => $totalOrderCurrent,
                ],
            ],
        ]);
    }

    public function sales(Request $request)
    {
        $now = Carbon::create(2025, 5, 25);
        $days = 14;

        // Get date ranges for last and current 7 days
        $currentDates = [];
        $lastDates = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $currentDates[] = $now->copy()->subDays($i)->toDateString();
            $lastDates[] = $now->copy()->subDays($i + $days)->toDateString();
        }

        // Get sales for current 7 days
        $currentSales = Order::whereBetween('order_date', [
            $currentDates[0], $currentDates[$days - 1]
        ])
        ->selectRaw('DATE(order_date) as date, SUM(total_price) as total')
        ->groupBy('date')
        ->pluck('total', 'date');

        // Get sales for last 7 days
        $lastSales = Order::whereBetween('order_date', [
            $lastDates[0], $lastDates[$days - 1]
        ])
        ->selectRaw('DATE(order_date) as date, SUM(total_price) as total')
        ->groupBy('date')
        ->pluck('total', 'date');

        // Prepare data for ApexChart
        $currentData = [];
        $lastData = [];
        foreach ($currentDates as $date) {
            $currentData[] = (float) ($currentSales[$date] ?? 0);
        }
        foreach ($lastDates as $date) {
            $lastData[] = (float) ($lastSales[$date] ?? 0);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'last_month' => $lastData,
                'current_month' => $currentData,
                'categories' => array_map(function($date) {
                    return date('d', strtotime($date));
                }, $currentDates),
            ],
        ]);
    }
}