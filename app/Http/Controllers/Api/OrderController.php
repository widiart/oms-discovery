<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getData(Request $request) {
        $request->validate([
            'start' => 'integer|min:0',
            'length' => 'integer|min:1|max:100',
        ]);

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $page = intval(floor($start / $length)) + 1;
        $orders = \App\Models\Order::query()
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'products.name as product_name'
            );

        if ($request->has('search') && $request->input('search')['value']) {
            $searchValue = $request->input('search')['value'];
            $orders->where(function($query) use ($searchValue) {
            $query->where('orders.order_number', 'like', '%' . $searchValue . '%')
                  ->orWhere('customers.name', 'like', '%' . $searchValue . '%')
                  ->orWhere('products.name', 'like', '%' . $searchValue . '%');
            });
        }

        // Apply ordering if provided
        if ($request->has('order') && is_array($request->input('order'))) {
            $columns = $request->input('columns', []);
            foreach ($request->input('order') as $order) {
                $columnIdx = $order['column'] ?? null;
                $dir = $order['dir'] ?? 'asc';
                if ($columnIdx !== null && isset($columns[$columnIdx]['data'])) {
                    $columnName = $columns[$columnIdx]['data'];
                    if (in_array($columnName, ['order_number', 'order_date', 'quantity', 'total_price', 'customer_name', 'product_name'])) {
                        $orders->orderBy($columnName, $dir);
                    }
                }
            }
        } else {
            $orders->orderBy('orders.order_date', 'desc');
        }

        $orders = $orders->paginate($length, ['*'], 'page', $page);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $orders->total(),
            'recordsFiltered' => $orders->total(),
            'data' => $orders->items(),
        ])->setStatusCode(200, 'Orders retrieved successfully');
    }

    public function read($id) {
        // Find the order by ID
        $order = \App\Models\Order::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Order retrieved successfully',
            'data' => $order,
        ])->setStatusCode(200, 'Order retrieved');
    }

    public function create(Request $request) {
        // Validate the request data
        $request->validate([
            'product_id' => 'required|numeric',
            'customer_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        $product = \App\Models\Product::findOrFail($request->input('product_id'));

        if($request->input('quantity') <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Quantity must be greater than zero',
            ])->setStatusCode(422, 'Invalid quantity');
        } else if($product->is_active == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Product is not available',
            ])->setStatusCode(422, 'Product not available');
        } else if($product->stock < $request->input('quantity')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient product quantity',
            ])->setStatusCode(422, 'Insufficient quantity');
        }

        // Create a new order
        $order = \App\Models\Order::create([
            'order_number' => 'ORD' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'product_id' => $request->input('product_id'),
            'customer_id' => $request->input('customer_id'),
            'quantity' => $request->input('quantity'),
            'total_price' => $request->input('quantity') * $product->price,
            'order_date' => now(),
        ]);

        // Reduce stock from the product
        $product->reduceStock($request->input('quantity'));

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order,
        ])->setStatusCode(201, 'Order created');
    }

    public function update(Request $request, $id) {
        // Validate the request data
        $request->validate([
            'order_number' => 'required|string|max:255|unique:orders,order_number,' . $id,
            'customer_name' => 'required|string|max:255',
            'total' => 'required|numeric',
        ]);

        // Find the order by ID
        $order = \App\Models\Order::findOrFail($id);
        // Update the order
        $order->update([
            'order_number' => $request->input('order_number'),
            'customer_name' => $request->input('customer_name'),
            'total' => $request->input('total'),
            'is_active' => $request->input('is_active', false) ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => $order,
        ])->setStatusCode(200, 'Order updated');
    }

    public function delete($id) {
        // Find the order by ID
        $order = \App\Models\Order::findOrFail($id);

        // Delete the order
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
        ])->setStatusCode(200, 'Order deleted');
    }

    public function complete($id) {
        // Find the order by ID
        $order = \App\Models\Order::findOrFail($id);

        // Update the order status to completed
        $order->update(['status' => 'completed']);

        return response()->json([
            'success' => true,
            'message' => 'Order completed successfully',
            'data' => $order,
        ])->setStatusCode(200, 'Order completed');
    }

    public function cancel($id) {
        // Find the order by ID
        $order = \App\Models\Order::findOrFail($id);

        // Update the order status to cancelled
        $order->update(['status' => 'cancelled']);
        $order->product->addStock($order->quantity); // Add stock back to product

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully',
            'data' => $order,
        ])->setStatusCode(200, 'Order cancelled');
    }
}