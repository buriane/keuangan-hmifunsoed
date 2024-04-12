<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pemasukan
        DB::table('transaksis')->insert([
            'dana_id' => 1,
            'tanggal' => '2022-05-20',
            'detail' => 'Kas HMIF',
            'keterangan' => 'Pemasukan',
            'nominal' => 200000
        ]);
        DB::table('transaksis')->insert([
            'dana_id' => 2,
            'tanggal' => '2022-08-04',
            'detail' => 'Dana Delegasi',
            'keterangan' => 'Pemasukan',
            'nominal' => 500000
        ]);

        // Pengeluaran
        DB::table('transaksis')->insert([
            'dana_id' => 1,
            'tanggal' => '2022-04-04',
            'detail' => 'ISC',
            'keterangan' => 'Pengeluaran',
            'nominal' => 100000
        ]);
        DB::table('transaksis')->insert([
            'dana_id' => 2,
            'tanggal' => '2022-08-04',
            'detail' => 'MM',
            'keterangan' => 'Pengeluaran',
            'nominal' => 200000
        ]);
    }
}
