<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tugas extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['tim_id','code','status_tugas', 'nama', 'prioritas', 'catatan_detail_id'];

    /**
     * tim
     *
     * @return BelongsTo
     */
    public function tim(): BelongsTo
    {
        return $this->belongsTo(Tim::class);
    }

    /**
     * user
     *
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'penugasans');
    }

    /**
     * comments
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    /**
     * penugasan
     *
     * @return BelongsTo
     */
    public function penugasan(): BelongsTo
    {
        return $this->belongsTo(Penugasan::class);
    }

     /**
     *
     * @return HasMany
     */
    public function subPenugasan(): HasMany
    {
        return $this->hasMany(Penugasan::class);
    }

    /**
     * label
     *
     * @return BelongsToMany
     */
    public function label(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'label_tugas');
    }

    /**
     * aktifitas
     *
     * @return void
     */
    public function aktifitas()
    {
        return $this->hasMany(Aktifitas::class);
    }

    public function catatanDetail(): BelongsTo
    {
        return $this->belongsTo(CatatanDetail::class);
    }

    public function catatan()
    {
        return $this->hasMany(Catatan::class);
    }
}
