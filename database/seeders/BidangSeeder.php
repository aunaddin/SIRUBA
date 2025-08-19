<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bidangs')->insert([
            ['nama' => 'SEKRETARIAT', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'LITBANG', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PEIPD', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PESDAI', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PPMP', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
