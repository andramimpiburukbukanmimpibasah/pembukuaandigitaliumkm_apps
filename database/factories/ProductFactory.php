<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'umkm_id' => null,
            'foto_produk' => null,
            'nama_produk' => $this->faker->word,
            'nama_brand' => $this->faker->company,
            'kategori_produk' => $this->faker->word,
            'deskripsi' => $this->faker->text,
            'harga' => $this->faker->numberBetween(10000, 500000),
            'stok' => $this->faker->numberBetween(0, 100),
        ];
    }
}