<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
