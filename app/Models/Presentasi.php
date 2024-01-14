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

    /**
     * tim
     *
     * @return BelongsTo
     */
    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }
    
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }
    /**
     * users
     *
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * user
     *
     * @return HasManyThrough
     */
    public function user(): HasManyThrough
    {
        return $this->through('tim')->has('user');
    }

    /**
     * historyPresentasi
     *
     * @return BelongsTo
     */
    public function historyPresentasi():BelongsTo
    {
        return $this->belongsTo(HistoryPresentasi::class);
    }

    /**
     * user_approval
     *
     * @return BelongsTo
     */
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

    /**
     * isPengujianDisetujui
     *
     * @return void
     */
    public function isPengujianDisetujui()
    {
        return $this->status_pengajuan === 'disetujui';
    }
    /**
     * isPengujianMenunggu
     *
     * @return void
     */
    public function isPengujianMenunggu()
    {
        return $this->status_pengajuan === 'menunggu';
    }

    /**
     * limitPresentasiDevisiId
     *
     * @return void
     */
    public function limitPresentasiDevisiId()
    {
        return $this->limit_presentasi_devisi_id;
    }
}
