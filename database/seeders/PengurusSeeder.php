<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penguruses')->insert([
            'nama' => 'Ahmad Rian Syaifullah Ritonga',
            'divisi' => 'BPH'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Athifa Nathania',
            'divisi' => 'BPH'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Eka Belandini',
            'divisi' => 'BPH'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Melyana Rizky Ramadhani',
            'divisi' => 'BPH'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Ayu Fitrianingsih',
            'divisi' => 'BPH'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Fina Julianti',
            'divisi' => 'BPH'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Revalina Fidiya Anugrah',
            'divisi' => 'BPH'
        ]);

        // Iltek
        DB::table('penguruses')->insert([
            'nama' => 'Desvania Tirta Izzati',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Firyal Aufa Fahrudin',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Annida Aiska Humairoh',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Brian Cahya Purnama',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Ageng Praba Wijaya',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => "Ghaza Indra Pratama",
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Athallah Tsany Satriyaji',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Rizki Arif Saifudin',
            'divisi' => 'ILTEK'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Aditya Fathan Naufaldi',
            'divisi' => 'ILTEK'
        ]);

        // Edu
        DB::table('penguruses')->insert([
            'nama' => 'Anindya Diva Talitha',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Nabila Winanda Meirani',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Dwi Bagus Purwo Aji',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Luthfi Emillulfata',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Defit Bagus Saputra',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Farah Tsani Maulida',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Fawwaz Aufa Al Ghautsa Rafi',
            'divisi' => 'EDUKASI'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Fauzia Azahra Depriani',
            'divisi' => 'EDUKASI'
        ]);

        // Humas
        DB::table('penguruses')->insert([
            'nama' => 'Mochamad Azizan',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Reva Septia Wulandari',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Muhammad Naufal Dzakwan',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Sufyan Abdur Rofiq',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Rasyad Dhawiabyaz',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Hidayatul Mangunah',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Dyah Ghaniya Putri',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Mufthie Alie',
            'divisi' => 'HUMAS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Muhammad Ilham rafiqi',
            'divisi' => 'HUMAS'
        ]);

        // Medkom
        DB::table('penguruses')->insert([
            'nama' => 'Claresta Berthalita Jatmika',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Nurafina Nazwani',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Raia Digna Amanda',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Muhamad Galih',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Abhirama Rizqi Pratama',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Nadzare Kafah Alfatiha',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Prasetyo Angga Permana',
            'divisi' => 'MEDKOM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Arsy wicaksono',
            'divisi' => 'MEDKOM'
        ]);

        // PSDM
        DB::table('penguruses')->insert([
            'nama' => 'Hamas Izzuddin Fathi',
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Ariza Nola Rufiana',
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Muhammad Fadhel Fausta',
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => "Abdul Aziz Fahmi 'Alauddin",
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Ukhti Nisa',
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Kintan Kinasih Mahaputri ',
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Nisa Izzatul Ummah',
            'divisi' => 'PSDM'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Audi Makrufianto Afetama',
            'divisi' => 'PSDM'
        ]);

        // Mikat
        DB::table('penguruses')->insert([
            'nama' => 'Achmad Aulia Difiputra',
            'divisi' => 'MIKAT'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Kamila Fajar Pertiwi',
            'divisi' => 'MIKAT'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Isma Fadhilatizzahra',
            'divisi' => 'MIKAT'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Fawwaz Afkar Muzakky',
            'divisi' => 'MIKAT'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Athaya Raihan Annafi',
            'divisi' => 'MIKAT'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Bilqis Sabrina Shatila',
            'divisi' => 'MIKAT'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Darrell Gibran',
            'divisi' => 'MIKAT'
        ]);

        // Kreus
        DB::table('penguruses')->insert([
            'nama' => "Syifa Rahmadani",
            'divisi' => 'KREUS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Fatimah Nurmawati',
            'divisi' => 'KREUS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Jasmine Adzra Fakhirah',
            'divisi' => 'KREUS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Nicholas Hasian',
            'divisi' => 'KREUS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Ratu Naurah Calista',
            'divisi' => 'KREUS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Mukhammad Alfaen Fadillah',
            'divisi' => 'KREUS'
        ]);
        DB::table('penguruses')->insert([
            'nama' => 'Simon Dimas Pramudya',
            'divisi' => 'KREUS'
        ]);
    }
}
