@extends('layouts.admin')

@section('title', 'Edit Ruang')
@section('header', 'Edit Ruang')

@section('content')
<div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-door-open me-2"></i> Edit Data Ruang
        </h5>
    </div>

    <div class="card-body">
        <form action="{{ route('ruang.update', $ruang) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Ruang</label>
                <input type="text" name="nama" class="form-control form-control-lg" 
                       value="{{ $ruang->nama }}" placeholder="Masukkan nama ruang" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kapasitas</label>
                <div class="input-group">
                    <input type="number" name="kapasitas" class="form-control form-control-lg"
                           value="{{ $ruang->kapasitas }}" placeholder="Masukkan kapasitas">
                    <span class="input-group-text">Orang</span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Lokasi</label>
                <input type="text" name="lokasi" class="form-control form-control-lg" 
                       value="{{ $ruang->lokasi }}" placeholder="Masukkan lokasi ruang">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('ruang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
    }

    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .btn-success {
        box-shadow: 0 3px 6px rgba(0, 128, 0, 0.3);
    }

    .btn-secondary {
        box-shadow: 0 3px 6px rgba(108, 117, 125, 0.3);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        .form-control-lg {
            font-size: 1rem;
            padding: 0.6rem;
        }
    }
</style>
@endsection
