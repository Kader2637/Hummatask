<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }

    public function tema(): BelongsTo
    {
        return $this->belongsTo(Tema::class);
    }
    public function anggota_tim()
    {
        return Anggota::where('tim_id', $this->tim->id)
            ->whereIn('status', ['active', 'expired'])
            ->whereHas('user', function ($query) {
                $query->where('status_kelulusan', 0);
            })
            ->get()
            ->sortBy('jabatan');
    }
    public function anggota_profile()
    {
        return Anggota::where('tim_id', $this->id)
            ->whereIn('status', ['active', 'expired', 'kicked'])
            ->with(['user', 'jabatan']) // Memuat relasi 'user
            ->orderByRaw("jabatan_id = 1 DESC")
            ->get();
    }
}
