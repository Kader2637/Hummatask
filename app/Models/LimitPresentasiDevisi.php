<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LimitPresentasiDevisi extends Model
{
    use HasFactory;

    protected $fillable = ['presentasi_divisi_id', 'mulai', 'akhir', 'jadwal_ke'];
    protected $guarded = [];

    /**
     * presentasiDivisi
     *
     * @return BelongsTo
     */ 
    public function presentasiDivisi(): BelongsTo
    {
        return $this->belongsTo(PresentasiDivisi::class, 'presentasi_divisi_id');
    }

    /**
     * presentasi
     *
     * @return HasMany
     */
    public function presentasi(): HasMany
    {
        return $this->hasMany(presentasi::class, 'limit_presentasi_devisi_id');
    }
}
