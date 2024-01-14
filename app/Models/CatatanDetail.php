<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatatanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * catatan
     *
     * @return HasMany
     */
    public function catatan(): HasMany
    {
        return $this->hasMany(catatan::class, 'catatan_id');
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
