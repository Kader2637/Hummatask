<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class catatan extends Model
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
        return $this->BelongsTo(Tim::class);
    }

    /**
     * catatanDetail
     *
     * @return HasMany
     */
    public function catatanDetail(): HasMany
    {
        return $this->HasMany(CatatanDetail::class, 'catatan_id', 'id');
    }

    public function catatan(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
