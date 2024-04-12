<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }
}
