<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danas')->insert([
            'nama' => 'GOPAY HMIF'
        ]);
        DB::table('danas')->insert([
            'nama' => 'BNI HMIF'
        ]);
        DB::table('danas')->insert([
            'nama' => 'Cash Melyana'
        ]);
        DB::table('danas')->insert([
            'nama' => 'Cash Fani'
        ]);
    }
}
