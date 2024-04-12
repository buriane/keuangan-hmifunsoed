<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $guarded = ['id', 'nama', 'divisi'];
}
