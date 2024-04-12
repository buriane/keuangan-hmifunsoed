<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit_history extends Model
{
    public $guarded = ['id'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }
}
