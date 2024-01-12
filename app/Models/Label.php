<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * tugas
     *
     * @return BelongsToMany
     */
    public function tugas(): BelongsToMany
    {
        return $this->belongsToMany(Tugas::class, 'label_tugas');
    }
}
