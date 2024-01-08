<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];
    protected $guarded = [];

    /**
     * presentasiDivisiHasOne
     *
     * @return HasOne
     */
    public function presentasiDivisiHasOne(): HasOne
    {
        return $this->hasOne(PresentasiDivisi::class, 'divisi_id');
    }


    
    /**
     * users
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'divisi_id');
    }
}
