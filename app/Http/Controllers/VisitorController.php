<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $this->updateStatusAutomatically();
        $today = now()->toDateString();
        $threeDaysLater = now()->addDays(3)->toDateString();

        $peminjamanBerlangsung = Peminjaman::with('ruang', 'bidang')
            ->where('status', 'ongoing')
            ->whereDate('tanggal', $today)
            ->get();

        // Ubah menjadi range tanggal
        $peminjamanMendatang = Peminjaman::with('ruang', 'bidang')
            ->where('status', 'pending')
            ->whereBetween('tanggal', [$today, $threeDaysLater])
            ->orderBy('tanggal', 'asc')
            ->get();

        $peminjamanSelesai = Peminjaman::with('ruang', 'bidang')
            ->where('status', 'completed')
            ->whereDate('tanggal', $today)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('visitor', compact('peminjamanBerlangsung', 'peminjamanMendatang', 'peminjamanSelesai'));
    }

    public function refresh()
    {
        $this->updateStatusAutomatically();
        $today = now()->toDateString();
        $threeDaysLater = now()->addDays(3)->toDateString();

        $ongoing = view('partials.visitor_ongoing', [
            'peminjamanBerlangsung' => Peminjaman::with('ruang', 'bidang')
                ->where('status', 'ongoing')
                ->whereDate('tanggal', $today)
                ->get()
        ])->render();

        // Ubah menjadi range tanggal
        $upcoming = view('partials.visitor_upcoming', [
            'peminjamanMendatang' => Peminjaman::with('ruang', 'bidang')
                ->where('status', 'pending')
                ->whereBetween('tanggal', [$today, $threeDaysLater])
                ->orderBy('tanggal', 'asc')
                ->get()
        ])->render();

        $history = view('partials.visitor_history', [
            'peminjamanSelesai' => Peminjaman::with('ruang', 'bidang')
                ->where('status', 'completed')
                ->whereDate('tanggal', $today)
                ->orderBy('tanggal', 'desc')
                ->get()
        ])->render();

        return response()->json(compact('ongoing', 'upcoming', 'history'));
    }

    private function updateStatusAutomatically()
    {
        $now = now();

        // Ubah pending → ongoing jika sedang berlangsung
        Peminjaman::where('status', 'pending')
            ->whereDate('tanggal', $now->toDateString())
            ->where('jam_mulai', '<=', $now->format('H:i:s'))
            ->where('jam_selesai', '>=', $now->format('H:i:s'))
            ->update(['status' => 'ongoing']);

        // Ubah pending/ongoing → completed jika sudah selesai
        Peminjaman::whereIn('status', ['pending', 'ongoing'])
            ->where(function ($q) use ($now) {
                $q->whereDate('tanggal', '<', $now->toDateString())
                  ->orWhere(function ($sub) use ($now) {
                      $sub->whereDate('tanggal', $now->toDateString())
                          ->where('jam_selesai', '<', $now->format('H:i:s'));
                  });
            })
            ->update(['status' => 'completed']);
    }
}
