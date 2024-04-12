<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas_history extends Model
{
    public $guarded = ['id'];

    public function kas()
    {
        return $this->belongsTo(Kas::class);
    }

    public function dana()
    {
        return $this->belongsTo(Dana::class);
    }
}
