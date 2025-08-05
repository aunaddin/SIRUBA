<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use Carbon\Carbon;

class UpdatePeminjamanStatus extends Command
{
    protected $signature = 'peminjaman:update-status';
    protected $description = 'Update status peminjaman secara otomatis (ongoing atau completed)';

    public function handle()
    {
        $now = Carbon::now();

        // Update status menjadi ongoing jika sedang berlangsung
        Peminjaman::where('status', 'pending')
            ->whereDate('tanggal', $now->toDateString())
            ->where('jam_mulai', '<=', $now->format('H:i:s'))
            ->where('jam_selesai', '>=', $now->format('H:i:s'))
            ->update(['status' => 'ongoing']);

        // Update status menjadi completed jika sudah selesai
        Peminjaman::whereIn('status', ['pending', 'ongoing'])
            ->where(function ($query) use ($now) {
                $query->whereDate('tanggal', '<', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->whereDate('tanggal', $now->toDateString())
                            ->where('jam_selesai', '<', $now->format('H:i:s'));
                    });
            })
            ->update(['status' => 'completed']);

        $this->info('Status peminjaman berhasil diperbarui!');
    }
}
