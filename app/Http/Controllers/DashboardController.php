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
        $jumlahPeminjaman = Peminjaman::count();
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
