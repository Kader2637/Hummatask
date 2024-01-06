<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanPresentasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * limitPresentasiDivisi
     *
     * @return BelongsTo
     */
    public function limitPresentasiDivisi(): BelongsTo
    {
        return $this->belongsTo(LimitPresentasiDevisi::class, 'limit_presentasi_devisi_id');
    }
}
