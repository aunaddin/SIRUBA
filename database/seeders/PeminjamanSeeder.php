<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peminjamans')->insert([
            [
                'bidang_id' => 1,
                'bidang_manual' => null,
                'ruang_id' => 1,
                'tanggal' => now()->toDateString(),
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '11:00:00',
                'nama_acara' => 'Rapat Koordinasi',
                'jumlah_peserta' => 10,
                'penanggung_jawab' => 'Budi Santoso',
                'keterangan' => 'Persiapan proyek baru',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
