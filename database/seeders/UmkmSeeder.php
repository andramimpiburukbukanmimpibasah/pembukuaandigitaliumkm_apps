<?php

namespace Database\Seeders;

use App\Models\Umkm;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::factory(3)->create();
    }
}
