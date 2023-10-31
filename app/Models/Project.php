<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $guarded=[

    ];

    public function anggota():BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function tim():BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }
    
}
