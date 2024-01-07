<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Presentasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }

    // untuk mangambil jumlah anak magang
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function user(): HasManyThrough
    {
        return $this->through('tim')->has('user');
    }

    public function historyPresentasi():BelongsTo
    {
        return $this->belongsTo(HistoryPresentasi::class);
    }

    public function user_approval():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * limitPresentasiDivisi
     *
     * @return BelongsTo
     */
    public function limitPresentasiDivisi(): BelongsTo
    {
        return $this->belongsTo(LimitPresentasiDevisi::class, 'limit_presentasi_devisi_id');
    }

    public function isPengujianDisetujui()
    {
        return $this->status_pengajuan === 'disetujui';
    }

    public function limitPresentasiDevisiId()
    {
        return $this->limit_presentasi_devisi_id;
    }
}
