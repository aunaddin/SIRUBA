@extends('layouts.admin')

@section('title', 'Riwayat Peminjaman')
@section('header', 'Riwayat Peminjaman')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <h5 class="mb-2 mb-md-0"><i class="fas fa-history me-2"></i> Riwayat Peminjaman</h5>
        
        {{-- Filter Form --}}
        <form action="{{ route('peminjaman.history') }}" method="GET" class="d-flex gap-2">
            <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
            
            <select name="ruang_id" class="form-control form-control-sm">
                <option value="">Semua Ruang</option>
                @foreach($ruangs as $ruang)
                    <option value="{{ $ruang->id }}" {{ request('ruang_id') == $ruang->id ? 'selected' : '' }}>
                        {{ $ruang->nama }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> Filter
            </button>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="fas fa-briefcase me-1"></i> Bidang</th>
                        <th><i class="fas fa-door-open me-1"></i> Ruang</th>
                        <th><i class="fas fa-calendar-alt me-1"></i> Tanggal</th>
                        <th><i class="fas fa-clock me-1"></i> Jam</th>
                        <th><i class="fas fa-bullhorn me-1"></i> Nama Acara</th>
                        <th><i class="fas fa-users me-1"></i> Peserta</th>
                        <th><i class="fas fa-user-tie me-1"></i> Penanggung Jawab</th>
                        <th><i class="fas fa-info-circle me-1"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $peminjaman->bidang->nama ?? $peminjaman->bidang_manual }}</td>
                            <td>{{ $peminjaman->ruang->nama }}</td>
                            <td>{{ $peminjaman->tanggal }}</td>
                            <td>{{ $peminjaman->jam_mulai }} - {{ $peminjaman->jam_selesai }}</td>
                            <td>{{ $peminjaman->nama_acara }}</td>
                            <td>{{ $peminjaman->jumlah_peserta }}</td>
                            <td>{{ $peminjaman->penanggung_jawab }}</td>
                            <td>
                                <span class="badge 
                                    @if($peminjaman->status === 'pending') bg-warning 
                                    @elseif($peminjaman->status === 'ongoing') bg-primary 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-3 text-muted">
                                <i class="fas fa-info-circle"></i> Belum ada riwayat peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-end">
        {{ $peminjamans->links() }}
    </div>
</div>
@endsection
