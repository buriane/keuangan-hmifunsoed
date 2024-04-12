<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'bendahara',
            'nama' => 'Bendahara',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'username' => 'kreus',
            'nama' => 'Kreus',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'username' => 'iltek',
            'nama' => 'Iltek',
            'password' => bcrypt('password')
        ]);
    }
}
