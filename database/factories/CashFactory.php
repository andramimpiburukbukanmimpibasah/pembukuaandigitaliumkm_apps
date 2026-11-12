<?php

namespace Database\Factories;

use App\Models\Cash;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashFactory extends Factory
{
    protected $model = Cash::class;

    public function definition(): array
    {
        return [
            'umkm_id' => null,
            'transaction_id' => null,
            'tanggal' => $this->faker->date,
            'jenis' => $this->faker->randomElement(['pemasukan', 'pengeluaran']),
            'kategori' => $this->faker->word,
            'nominal' => $this->faker->numberBetween(1000, 100000),
            'metode' => $this->faker->randomElement(['Tunai', 'Transfer']),
            'keterangan' => $this->faker->sentence,
        ];
    }
}