<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Anggota extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'id','nama_jabatan');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tim():HasOne
    {
        return $this->hasOne(Tim::class, 'id', 'tim_id');

    }
}
