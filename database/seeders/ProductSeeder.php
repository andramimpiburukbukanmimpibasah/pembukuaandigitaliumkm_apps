<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Umkm;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::all()->each(function ($umkm) {
            Product::factory(5)->create([
                'umkm_id' => $umkm->id,
            ]);
        });
    }
}
