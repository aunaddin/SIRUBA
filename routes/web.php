<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\VisitorController;

// Halaman utama diarahkan ke login
Route::get('/', [VisitorController::class, 'index'])->name('visitor.home');

// Route untuk login & logout
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route hanya untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('ruang', RuangController::class);
    Route::resource('bidang', BidangController::class);

    // History harus di-declare sebelum resource
    Route::get('/peminjaman/history', [PeminjamanController::class, 'history'])->name('peminjaman.history');

    // Resource peminjaman tanpa show (supaya tidak bentrok dengan history)
    Route::resource('peminjaman', PeminjamanController::class)->except(['show']);
});

Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');
Route::get('/visitor/refresh', [VisitorController::class, 'refresh'])->name('visitor.refresh');