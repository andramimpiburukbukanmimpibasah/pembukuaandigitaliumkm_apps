<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUmkm
{
    protected static function bootBelongsToUmkm(): void
    {
        static::addGlobalScope('umkm', function (Builder $builder) {
            if (auth()->check() && auth()->user()->umkm_id) {
                $builder->where((new static)->getTable().'.umkm_id', auth()->user()->umkm_id);
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->umkm_id && empty($model->umkm_id)) {
                $model->umkm_id = auth()->user()->umkm_id;
            }
        });
    }

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class);
    }
}
