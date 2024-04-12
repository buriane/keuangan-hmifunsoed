<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KreusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // pemasukan
        DB::table('kreuses')->insert([
            'bulan' => '4',
            'kategori' => 'Pemasukan',
            'proker' => 'Jantung',
            'sumber' => 'Kas HMIF',
            'pemasukan' => 200000,
            'pj' => 'Katarina Putri'
        ]);
        DB::table('kreuses')->insert([
            'bulan' => '5',
            'kategori' => 'Pemasukan',
            'proker' => 'Infinity Wear',
            'sumber' => 'Iuran Pengurus',
            'pemasukan' => 800000,
            'pj' => 'Anisa Meilia'
        ]);

        // pengeluaran kreus
        DB::table('kreuses')->insert([
            'bulan' => '4',
            'kategori' => 'Pengeluaran Kreus',
            'proker' => 'Jantung',
            'keterangan' => 'Pembelian Bahan',
            'pengeluaran' => 100000,
            'pj' => 'Katarina Putri'
        ]);
        DB::table('kreuses')->insert([
            'bulan' => '5',
            'kategori' => 'Pengeluaran Kreus',
            'proker' => 'Infinity Wear',
            'keterangan' => 'Uang Muka',
            'pengeluaran' => 500000,
            'pj' => 'Anisa Meilia'
        ]);

        // pengeluaran diluar kreus
        DB::table('kreuses')->insert([
            'bulan' => '4',
            'kategori' => 'Pengeluaran diluar Kreus',
            'proker' => 'IC',
            'tanggal' => '2022-07-10',
            'pengeluaran' => 50000
        ]);
        DB::table('kreuses')->insert([
            'bulan' => '5',
            'kategori' => 'Pengeluaran diluar Kreus',
            'proker' => 'Diesnat',
            'tanggal' => '2022-08-15',
            'pengeluaran' => 15000
        ]);
    }
}
