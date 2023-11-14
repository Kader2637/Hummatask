<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenglolaMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'awal_menjabat',
        'akhir_menjabat',
        'masih_menjabat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
