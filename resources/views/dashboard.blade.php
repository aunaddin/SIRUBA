@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <!-- Card Jumlah Ruang -->
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 text-white" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-door-open fa-3x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $jumlahRuang }}</h5>
                        <p class="mb-0">Jumlah Ruang</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Bidang -->
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 text-white" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $jumlahBidang }}</h5>
                        <p class="mb-0">Jumlah Bidang</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Peminjaman -->
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-lg border-0 rounded-4 text-white" style="background: linear-gradient(135deg, #f7971e, #ffd200);">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">{{ $jumlahPeminjaman }}</h5>
                        <p class="mb-0">Peminjaman Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Peminjaman Terbaru -->
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Peminjaman Terbaru</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Bidang</th>
                            <th>Ruang</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Acara</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamanTerbaru as $p)
                            <tr>
                                <td>{{ $p->bidang->nama ?? $p->bidang_manual }}</td>
                                <td>{{ $p->ruang->nama }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                                <td>{{ $p->nama_acara }}</td>
                                <td>
                                    @php
                                        $statusClass = match($p->status) {
                                            'pending' => 'warning',
                                            'ongoing' => 'primary',
                                            'completed' => 'secondary',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst($p->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data peminjaman</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    @media (max-width: 768px) {
        .card-body {
            flex-direction: column;
            text-align: center;
        }
        .card-body i {
            margin-bottom: 10px;
        }
    }
</style>
@endsection
