<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $guarded = [
        'id'
    ];

    public function dana()
    {
        return $this->belongsTo(Dana::class);
    }
}
