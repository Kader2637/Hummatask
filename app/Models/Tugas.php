<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function user():BelongsToMany
    {
        return $this->belongsToMany(User::class,'penugasans');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function penugasan(): BelongsTo
    {
        return $this->belongsTo(Penugasan::class);
    }

}
