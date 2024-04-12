<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kas_histories')->insert([
            'tanggal' => '2022-05-04',
            'dana_id' => 1,
            'kas_id' => 1,
            'bulan' => 'Mei',
            'nominal' => 15000
        ]);
        DB::table('kas_histories')->insert([
            'tanggal' => '2022-06-10',
            'dana_id' => 2,
            'kas_id' => 2,
            'bulan' => 'Juni',
            'nominal' => 15000
        ]);
        DB::table('kas_histories')->insert([
            'tanggal' => '2022-06-20',
            'dana_id' => 1,
            'kas_id' => 3,
            'bulan' => 'Juli',
            'nominal' => 17000
        ]);
    }
}
