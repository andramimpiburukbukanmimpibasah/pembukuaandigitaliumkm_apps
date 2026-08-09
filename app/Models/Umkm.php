<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_usaha',
        'logo',
        'nama_brand',
        'pemilik',
        'alamat',
        'no_hp',
        'jenis_usaha',
        'deskripsi_usaha',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function cashes(): HasMany
    {
        return $this->hasMany(Cash::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
