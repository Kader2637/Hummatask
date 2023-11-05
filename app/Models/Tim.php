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
        return $this->belongsToMany(User::class, 'anggotas')->wherePivot('jabatan_id',1);
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }

    public function presentasi(): HasMany
    {
        return $this->hasMany(Presentasi::class);
    }

    public function tema(): HasMany
    {
        return $this->hasMany(Tema::class);
    }

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
