<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'umkm_id' => null,
            'no_transaksi' => 'TRX-' . $this->faker->bothify('????-####'),
            'tanggal_transaksi' => $this->faker->date,
            'jenis' => 'penjualan',
            'product_id' => null,
            'jumlah' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->numberBetween(10000, 500000),
            'metode_pembayaran' => $this->faker->randomElement(['Tunai', 'Transfer', 'Qris']),
            'keterangan' => $this->faker->sentence,
        ];
    }
}