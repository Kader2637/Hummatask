<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LimitPresentasiDevisi extends Model
{
    use HasFactory;

    protected $fillable = ['presentasi_divisi_id', 'mulai', 'akhir'];
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
     * pengajuanPresentasis
     *
     * @return HasMany
     */
    public function pengajuanPresentasis(): HasMany
    {
        return $this->hasMany(PengajuanPresentasi::class, 'limit_presentasi_devisi_id');
    }
}
