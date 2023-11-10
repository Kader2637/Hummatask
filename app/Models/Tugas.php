<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tugas extends Model
{
    use HasFactory;

    protected $guarded=[
    ];
// sesuai yang ada didala array
    protected $fillable=['status_tugas','nama','prioritas'];

    public function tim():BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}
