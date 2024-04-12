<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public $guarded = [
        'id'
    ];

    public function dana()
    {
        return $this->belongsTo(Dana::class);
    }
}
