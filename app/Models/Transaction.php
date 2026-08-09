<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUmkm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory, BelongsToUmkm;

    protected $fillable = [
        'umkm_id',
        'no_transaksi',
        'tanggal_transaksi',
        'jenis',
        'product_id',
        'jumlah',
        'total',
        'metode_pembayaran',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_transaksi' => 'date',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
