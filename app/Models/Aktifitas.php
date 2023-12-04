<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    use HasFactory;

    protected $guarded=[

    ];

    public function user(){
        return $this->belongsTo(User::class,'pelaku_id');
    }

    public function tugas(){
        return $this->belongsTo(Tugas::class);
    }

    public function aktifitasData(){
        return $this->hasMany(AktifitasData::class);
    }
    public function aktifitasDataUser(){
        return $this->hasMany(AktifitasData::class)->where("status","penugasan");
    }
    public function aktifitasDataLabel(){
        return $this->hasMany(AktifitasData::class)->where("status","label");
    }
}

