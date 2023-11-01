<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user(): HasManyThrough
    {
        return $this->through('tim')->has('user');
    }
}
