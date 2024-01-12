<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'pelaku_id');
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

    /**
     * aktifitasData
     *
     * @return void
     */
    public function aktifitasData()
    {
        return $this->hasMany(AktifitasData::class);
    }

    /**
     * aktifitasDataUser
     *
     * @return void
     */
    public function aktifitasDataUser()
    {
        return $this->hasMany(AktifitasData::class)->where("status", "penugasan");
    }

    /**
     * aktifitasDataLabel
     *
     * @return void
     */
    public function aktifitasDataLabel()
    {
        return $this->hasMany(AktifitasData::class)->where("status", "label");
    }
}
