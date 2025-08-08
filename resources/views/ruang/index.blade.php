@extends('layouts.admin')

@section('title', 'Daftar Ruang')
@section('header', 'Daftar Ruang')

@section('content')

{{-- Tombol Tambah Ruang --}}
<div class="mb-3 d-flex justify-content-between align-items-center flex-wrap">
    <a href="{{ route('ruang.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> Tambah Ruang
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white fw-bold">
        Daftar Ruang
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0 ruang-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kapasitas</th>
                        <th>Lokasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangs as $ruang)
                        <tr>
                            <td data-label="#"> {{ $loop->iteration }} </td>
                            <td data-label="Nama" class="fw-semibold">{{ $ruang->nama }}</td>
                            <td data-label="Kapasitas">
                                <span class="badge bg-info">{{ $ruang->kapasitas ?? '-' }} Orang</span>
                            </td>
                            <td data-label="Lokasi">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ $ruang->lokasi ?? '-' }}
                            </td>
                            <td data-label="Aksi" class="text-center">
                                <a href="{{ route('ruang.edit', $ruang) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ruang.destroy', $ruang) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus ruang ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $ruangs->links() }}
</div>

<style>
    .card {
        border-radius: 10px;
    }

    .card-header {
        font-size: 16px;
        padding: 12px 15px;
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }

    .table-hover tbody tr:hover {
        background-color: #eef3ff;
    }

    .badge.bg-info {
        background: linear-gradient(45deg, #36b9cc, #2c9faf);
    }

    /* Responsif Mobile */
    @media (max-width: 768px) {
        .ruang-table thead {
            display: none;
        }

        .ruang-table tbody tr {
            display: flex;
            flex-direction: column;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 12px;
            padding: 10px;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .ruang-table tbody tr td {
            border: none;
            padding: 4px 0;
        }

        /* Baris atas: nomor, nama, kapasitas sejajar di kiri */
        .ruang-table tbody tr td:first-child,
        .ruang-table tbody tr td:nth-child(2),
        .ruang-table tbody tr td:nth-child(3) {
            display: inline-block;
            margin-right: 10px;
        }

        .ruang-table tbody tr td:first-child {
            font-weight: bold;
            color: #555;
        }

        .ruang-table tbody tr td:nth-child(2) {
            font-weight: 600;
        }

        .ruang-table tbody tr td:nth-child(3) {
            display: inline-block;
        }

        /* Lokasi dan aksi di bawah */
        .ruang-table tbody tr td:nth-child(4),
        .ruang-table tbody tr td:nth-child(5) {
            margin-top: 8px;
        }

        .ruang-table tbody td[data-label]:before {
            display: none;
        }
    }
</style>
@endsection
