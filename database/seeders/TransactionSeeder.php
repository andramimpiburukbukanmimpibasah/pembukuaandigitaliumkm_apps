<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Product::all()->each(function ($product) {
            Transaction::factory(3)->create([
                'umkm_id' => $product->umkm_id,
                'product_id' => $product->id,
            ]);
        });
    }
}
