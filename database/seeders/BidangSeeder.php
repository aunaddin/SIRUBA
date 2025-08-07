<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bidangs')->insert([
            ['nama' => 'Bidang IT', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bidang Keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bidang Umum', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
