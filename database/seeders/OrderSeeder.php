<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productPrices = [
            18000000, 16000000, 12000000, 14000000, 13000000, 9000000, 15000000,
            11000000, 10000000, 17000000, 9500000, 7000000, 13500000, 12000000,
            8000000, 6000000, 7500000, 10000000, 9000000, 12500000, 9500000,
            10500000, 8500000, 5000000, 8000000, 7000000
        ];

        $aprilData = collect(range(1, 37))->map(function ($i) use ($productPrices) {
            $customerCount = 3;
            $productCount = 26;
            $customerId = rand(1, $customerCount);
            $productId = rand(1, $productCount);

            $quantity = rand(1, 3);
            $totalPrice = $productPrices[$productId - 1] * $quantity;
            $orderDate = now()->setDate(2025, 4, rand(1, 30))->setTime(rand(8, 20), rand(0, 59), rand(0, 59));

            return [
                'order_number' => 'ORD' . $orderDate->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'customer_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'order_date' => $orderDate,
                'status' => rand(0, 1) ? 'completed' : 'cancelled',
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ];
        })->toArray();

        $meiData = collect(range(1, 50))->map(function ($i) use ($productPrices) {
            $customerCount = 5;
            $productCount = 26;
            $customerId = rand(1, $customerCount);
            $productId = rand(1, $productCount);

            $quantity = rand(1, 3);
            $totalPrice = $productPrices[$productId - 1] * $quantity;
            $orderDate = now()->setDate(2025, 5, rand(1, 30))->setTime(rand(8, 20), rand(0, 59), rand(0, 59));

            return [
                'order_number' => 'ORD' . $orderDate->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'customer_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'order_date' => $orderDate,
                'status' => rand(0, 1) ? 'completed' : 'cancelled',
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ];
        })->toArray();

        DB::table('orders')->insert($aprilData);
        DB::table('orders')->insert($meiData);
    }
}
