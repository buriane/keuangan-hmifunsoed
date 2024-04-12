<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas_history extends Model
{
    use HasFactory;

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
