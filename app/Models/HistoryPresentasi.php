<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HistoryPresentasi extends Model
{
    use HasFactory;

    protected $guarded;

    public function presentasi():HasMany
    {
        return $this->hasMany(Presentasi::class);
    }
}



