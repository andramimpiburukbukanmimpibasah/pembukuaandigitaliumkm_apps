<?php

namespace Database\Seeders;

use App\Models\Cash;
use App\Models\Umkm;
use Illuminate\Database\Seeder;

class CashSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::all()->each(function ($umkm) {
            Cash::factory(5)->create([
                'umkm_id' => $umkm->id,
            ]);
        });
    }
}
