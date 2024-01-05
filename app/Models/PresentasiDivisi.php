<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PresentasiDivisi extends Model
{
    use HasFactory;

    protected $table = 'presentasi_divisis';
    protected $guarded = [];
    protected $fillable = ['id', 'day', 'divisi'];

    /**
     * limitPresentasiDivisis
     *
     * @return HasMany
     */
    public function limitPresentasiDivisis(): HasMany
    {
        return $this->hasMany(LimitPresentasiDevisi::class, 'presentasi_divisi_id');
    }
}
