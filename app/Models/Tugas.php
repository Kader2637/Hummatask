<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Tugas extends Model
{
    use HasFactory;

    protected $guarded=[

    ];

    public function tim():BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }

     /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the primary key type.
     *
     * @return string
     */
    protected $keyType = 'string';

    /**
     * Get the key name for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'id';
    }


}
