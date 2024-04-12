<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deposit_histories')->insert([
            'tanggal' => '2022-05-04',
            'deposit_id' => 1,
            'keterangan' => 'Tidak menggunakan jahim ketika jahim day',
            'nominal' => 1000
        ]);
        DB::table('deposit_histories')->insert([
            'tanggal' => '2022-06-10',
            'deposit_id' => 2,
            'keterangan' => 'Tidak mengikuti rapat pleno',
            'nominal' => 15000
        ]);
        DB::table('deposit_histories')->insert([
            'tanggal' => '2022-06-20',
            'deposit_id' => 3,
            'keterangan' => 'Tidak mengikuti piket pesek',
            'nominal' => 10000
        ]);
    }
}
