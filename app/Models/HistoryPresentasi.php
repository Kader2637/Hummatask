<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class HistoryPresentasi extends Model
{
    use HasFactory;

    protected $guarded;

    public function presentasi():HasMany
    {
        return $this->hasMany(Presentasi::class);
    }

    public function tim():HasManyThrough
    {
        return $this->hasManyThrough(Tim::class,Presentasi::class);
    }

    public function tidakPresentasiMingguan()
    {
        return $this->hasMany(TidakPresentasiMingguan::class);
    }
    
}



