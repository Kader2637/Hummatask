<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class HistoryPresentasi extends Model
{
    use HasFactory;

    protected $guarded;

    /**
     * presentasi
     *
     * @return HasMany
     */
    public function presentasi(): HasMany
    {
        return $this->hasMany(Presentasi::class);
    }

    /**
     * tim
     *
     * @return HasManyThrough
     */
    public function tim(): HasManyThrough
    {
        return $this->hasManyThrough(Tim::class, Presentasi::class);
    }

    /**
     * tidakPresentasiMingguan
     *
     * @return void
     */
    public function tidakPresentasiMingguan()
    {
        return $this->hasMany(TidakPresentasiMingguan::class);
    }

    /**
     * divisi
     *
     * @return BelongsTo
     */
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }
}
