<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['user_id', 'tugas_id', 'text'];

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * tugas
     *
     * @return void
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
