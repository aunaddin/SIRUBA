@extends('layouts.admin')

@section('title', 'Daftar Bidang')
@section('header', 'Daftar Bidang')

@section('content')
<div class="mb-3">
    <a href="{{ route('bidang.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Bidang
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fas fa-briefcase me-2"></i>
        <h5 class="mb-0 flex-grow-1">Daftar Bidang</h5>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Bidang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bidangs as $bidang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bidang->nama }}</td>
                        <td>
                            <a href="{{ route('bidang.edit', $bidang) }}" class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('bidang.destroy', $bidang) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus bidang ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
