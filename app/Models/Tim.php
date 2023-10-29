<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tim extends Model
{
    use HasFactory;

    protected $guarded=[

    ];

    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'anggotas');
    }
    public function tugas():HasMany
    {
        return $this->hasMany(Tugas::class);
    }

}
