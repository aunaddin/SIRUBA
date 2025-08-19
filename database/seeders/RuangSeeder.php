<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ruangs')->insert([
            ['nama' => 'Kepala Bappeda', 'kapasitas' => 15, 'lokasi' => 'Gedung B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sekertariat Bappeda', 'kapasitas' => 15, 'lokasi' => 'Gedung B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Aula Progo', 'kapasitas' => 250, 'lokasi' => 'Gedung B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Prau', 'kapasitas' => 50, 'lokasi' => 'Gedung A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sindoro', 'kapasitas' => 50, 'lokasi' => 'Gedung A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sumbing', 'kapasitas' => 50, 'lokasi' => 'Gedung A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Maron', 'kapasitas' => 30, 'lokasi' => 'Gedung A', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
