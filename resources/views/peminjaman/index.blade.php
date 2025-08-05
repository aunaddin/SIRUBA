@extends('layouts.admin')

@section('header', 'Daftar Peminjaman')

@section('content')

{{-- Tombol Tambah Peminjaman --}}
<div class="mb-3">
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Peminjaman
    </a>
</div>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Card untuk tabel --}}
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-calendar-check"></i> Daftar Peminjaman
        </h5>
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
                        <th>Peserta</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                        <tr>
                            <td>{{ $p->bidang->nama ?? $p->bidang_manual }}</td>
                            <td>{{ $p->ruang->nama }}</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                            <td>{{ $p->nama_acara }}</td>
                            <td>{{ $p->jumlah_peserta }}</td>
                            <td>{{ $p->penanggung_jawab }}</td>
                            <td>
                                @php
                                    $statusIcon = [
                                        'pending' => '<i class="fas fa-hourglass-half text-warning"></i>',
                                        'ongoing' => '<i class="fas fa-play text-primary"></i>',
                                        'completed' => '<i class="fas fa-check-circle text-secondary"></i>',
                                    ];
                                    $statusClass = [
                                        'pending' => 'warning',
                                        'ongoing' => 'primary',
                                        'completed' => 'secondary',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusClass[$p->status] ?? 'secondary' }}">
                                    {!! $statusIcon[$p->status] ?? '' !!} {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('peminjaman.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus peminjaman ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Tidak ada data peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
