<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tim extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas');
    }
    public function ketuaTim(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas')->wherePivot('jabatan_id', 1);
    }
    public function AnggotaTim(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas')->wherePivot('jabatan_id', '!=', 1);
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }

    public function presentasi(): HasMany
    {
        return $this->hasMany(Presentasi::class);
    }

    public function presentasiSelesai(): HasMany
    {
        return $this->hasMany(Presentasi::class)->where('status_presentasi', 'selesai')->latest();
    }

    public function tema(): HasMany
    {
        return $this->hasMany(Tema::class);
    }

    // public function tema_id()
    // {
    //     return Tema::where('tim_id', $this->id)->get();
    // }

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function divisi_id(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }

    public function tidakPresentasiMingguan(): HasMany
    {
        return $this->hasMany(TidakPresentasiMingguan::class);
    }

    public function anggota_id()
    {
        return Anggota::where('tim_id', $this->id)->whereIn('status', ['active', 'expired'])->pluck('user_id');
    }

    public function anggota_tim()
    {
        return Anggota::where('tim_id', $this->id)
            ->whereIn('status', ['active', 'expired'])
            ->whereHas('user', function ($query) {
                $query->where('status_kelulusan', 0);
            })
            ->get();
    }
    public function anggota_profile()
    {
        return Anggota::where('tim_id', $this->id)
        ->whereIn('status', ['active', 'expired', 'kicked'])
        ->with(['user','jabatan']) // Memuat relasi 'user'
        ->orderByRaw("jabatan_id = 1 DESC")
        ->get();
    }
}
