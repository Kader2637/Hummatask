<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelTugas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function label()
    {
        return $this->belongsTo(Label::class, 'label_id', 'id');
    }
}
