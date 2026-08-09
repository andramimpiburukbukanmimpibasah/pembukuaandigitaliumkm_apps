<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUmkm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, BelongsToUmkm;

    protected $fillable = [
        'umkm_id',
        'foto_produk',
        'nama_produk',
        'nama_brand',
        'kategori_produk',
        'deskripsi',
        'harga',
        'stok',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
