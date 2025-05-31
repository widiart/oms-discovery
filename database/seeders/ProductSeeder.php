<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone 14 Pro',
                'price' => 18000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'price' => 16000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi 13 Pro',
                'price' => 12000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'OPPO Find X5 Pro',
                'price' => 14000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vivo X80 Pro',
                'price' => 13000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Realme GT 2 Pro',
                'price' => 9000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Google Pixel 7 Pro',
                'price' => 15000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ASUS ROG Phone 6',
                'price' => 11000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'OnePlus 11',
                'price' => 10000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony Xperia 1 IV',
                'price' => 17000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Motorola Edge 30 Pro',
                'price' => 9500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nokia X30',
                'price' => 7000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Huawei P50 Pro',
                'price' => 13500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lenovo Legion Phone Duel 2',
                'price' => 12000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'POCO F4 GT',
                'price' => 8000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Infinix Zero Ultra',
                'price' => 6000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tecno Phantom X2',
                'price' => 7500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sharp Aquos R7',
                'price' => 10000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ZTE Axon 40 Ultra',
                'price' => 9000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Honor Magic4 Pro',
                'price' => 12500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meizu 18s Pro',
                'price' => 9500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Black Shark 5 Pro',
                'price' => 10500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Redmi K50 Pro',
                'price' => 8500000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Realme Narzo 50 Pro',
                'price' => 5000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Oppo Reno8 Pro',
                'price' => 8000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vivo V25 Pro',
                'price' => 7000000,
                'stock' => rand(5, 10),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
