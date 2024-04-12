<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iltek extends Model
{
    use HasFactory;

    public static function bulan($x)
    {
        switch ($x) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
            default:
                return 'Semua';
                break;
        }
    }

    protected $guarded = [
        'id'
    ];
}
