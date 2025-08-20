<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Bidang;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahRuang = Ruang::count();
        $jumlahBidang = Bidang::count();

        // Hanya hitung peminjaman dengan status on going atau pending
        $jumlahPeminjaman = Peminjaman::whereIn('status', ['ongoing', 'pending'])->count();

        // Peminjaman terbaru tetap tampil semua (opsional bisa difilter juga kalau mau)
        $peminjamanTerbaru = Peminjaman::with('ruang', 'bidang')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'jumlahRuang',
            'jumlahBidang',
            'jumlahPeminjaman',
            'peminjamanTerbaru'
        ));
    }
}
