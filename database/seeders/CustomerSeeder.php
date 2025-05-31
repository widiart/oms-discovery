<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'Andi Pratama',
                'email' => 'andi.pratama@example.com',
                'phone' => '081234567890',
                'created_at' => '2025-04-01 10:00:00',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'phone' => '081298765432',
                'created_at' => '2025-04-05 11:00:00',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone' => '081377788899',
                'created_at' => '2025-04-10 12:00:00',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'phone' => '081355566677',
                'created_at' => '2025-05-15 13:00:00',
            ],
            [
                'name' => 'Rizky Ramadhan',
                'email' => 'rizky.ramadhan@example.com',
                'phone' => '081322233344',
                'created_at' => '2025-05-20 14:00:00',
            ],
            [
                'name' => 'Fitriani Putri',
                'email' => 'fitriani.putri@example.com',
                'phone' => '081399988877',
                'created_at' => '2025-05-25 15:00:00',
            ],
            [
                'name' => 'Agus Wijaya',
                'email' => 'agus.wijaya@example.com',
                'phone' => '081344455566',
                'created_at' => '2025-05-30 16:00:00',
            ],
        ]);
    }
}
