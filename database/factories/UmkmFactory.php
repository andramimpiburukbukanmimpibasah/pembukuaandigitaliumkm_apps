<?php

namespace Database\Factories;

use App\Models\Umkm;
use Illuminate\Database\Eloquent\Factories\Factory;

class UmkmFactory extends Factory
{
    protected $model = Umkm::class;

    public function definition(): array
    {
        return [
            'nama_usaha' => $this->faker->company,
            'pemilik' => $this->faker->name,
            'alamat' => $this->faker->address,
            'no_hp' => $this->faker->phoneNumber,
            'logo' => null,
            'nama_brand' => $this->faker->company,
            'jenis_usaha' => $this->faker->word,
            'deskripsi_usaha' => $this->faker->text,
            'mata_uang' => 'IDR',
            'catatan_struk' => null,
        ];
    }
}