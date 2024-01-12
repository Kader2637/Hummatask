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

    /**
     * user
     *
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas');
    }

    /**
     * ketuaTim
     *
     * @return BelongsToMany
     */
    public function ketuaTim(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas')->wherePivot('jabatan_id', 1);
    }

    /**
     * AnggotaTim
     *
     * @return BelongsToMany
     */
    public function AnggotaTim(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas')->wherePivot('jabatan_id', '!=', 1);
    }

    /**
     * tugas
     *
     * @return HasMany
     */
    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }

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
     * presentasiSelesai
     *
     * @return HasMany
     */
    public function presentasiSelesai(): HasMany
    {
        return $this->hasMany(Presentasi::class)
            ->where('status_presentasi', 'selesai')
            ->latest();
    }

    /**
     * tema
     *
     * @return HasMany
     */
    public function tema(): HasMany
    {
        return $this->hasMany(Tema::class);
    }

    /**
     * anggota
     *
     * @return HasMany
     */
    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    /**
     * project
     *
     * @return HasMany
     */
    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * tidakPresentasiMingguan
     *
     * @return HasMany
     */
    public function tidakPresentasiMingguan(): HasMany
    {
        return $this->hasMany(TidakPresentasiMingguan::class);
    }

    /**
     * anggota_id
     *
     * @return void
     */
    public function anggota_id()
    {
        return Anggota::where('tim_id', $this->id)
            ->whereIn('status', ['active', 'expired'])
            ->pluck('user_id');
    }

    /**
     * anggota_tim
     *
     * @return void
     */
    public function anggota_tim()
    {
        return Anggota::where('tim_id', $this->id)
            ->whereIn('status', ['active', 'expired'])
            ->whereHas('user', function ($query) {
                $query->where('status_kelulusan', 0);
            })
            ->get()
            ->sortBy('jabatan');
    }

    /**
     * anggota_profile
     *
     * @return void
     */
    public function anggota_profile()
    {
        return Anggota::where('tim_id', $this->id)
            ->whereIn('status', ['active', 'expired', 'kicked'])
            ->with(['user', 'jabatan']) // Memuat relasi 'user'
            ->orderByRaw('jabatan_id = 1 DESC')
            ->get();
    }

    /**
     * divisi
     *
     * @return BelongsTo
     */
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
