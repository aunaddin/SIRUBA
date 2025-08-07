<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ruangs')->insert([
            ['nama' => 'Ruang Rapat 1', 'kapasitas' => 20, 'lokasi' => 'Lantai 1', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Ruang Rapat 2', 'kapasitas' => 15, 'lokasi' => 'Lantai 2', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Aula Besar', 'kapasitas' => 50, 'lokasi' => 'Lantai 3', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
