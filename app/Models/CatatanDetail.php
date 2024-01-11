<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatatanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function catatan(): HasMany
    {
        return $this->hasMany(catatan::class, 'catatan_id');
    }
}
