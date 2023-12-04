<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AktifitasData extends Model
{
    use HasFactory;

    protected $guarded=[

    ];

    public function aktifitas():BelongsTo
    {
        return $this->belongsTo(Aktifitas::class);
    }

    public function label():BelongsTo
    {
         return $this->belongsTo(Label::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
