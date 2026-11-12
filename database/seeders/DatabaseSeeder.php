<?php

namespace Database\Seeders;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UmkmSeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class,
            CashSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin UMKM',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'umkm_id' => Umkm::first()?->id,
        ]);
    }
}
