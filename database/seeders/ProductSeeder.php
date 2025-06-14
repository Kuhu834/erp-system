<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 55000.00,
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartphone',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 30000.00,
                'quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 1500.00,
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mouse',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 800.00,
                'quantity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Monitor',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 12000.00,
                'quantity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Printer',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 9000.00,
                'quantity' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tablet',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 22000.00,
                'quantity' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Webcam',
                'sku' => 'SKU-' . Str::random(5),
                'price' => 2500.00,
                'quantity' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
