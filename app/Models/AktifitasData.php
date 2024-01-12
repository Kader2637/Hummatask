<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AktifitasData extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * aktifitas
     *
     * @return BelongsTo
     */
    public function aktifitas(): BelongsTo
    {
        return $this->belongsTo(Aktifitas::class);
    }

    /**
     * label
     *
     * @return BelongsTo
     */
    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);
    }

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
