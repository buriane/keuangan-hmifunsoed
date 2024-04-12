<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit_payment extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public function dana()
    {
        return $this->belongsTo(Dana::class);
    }
}
