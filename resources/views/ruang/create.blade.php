@extends('layouts.admin')

@section('title', 'Tambah Ruang')
@section('header', 'Tambah Ruang')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-gradient-primary text-white fw-bold">
        <i class="fas fa-door-open me-2"></i> Tambah Ruang
    </div>
    <div class="card-body">
        <form action="{{ route('ruang.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Ruang</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama ruang" required>
                <div class="invalid-feedback">Nama ruang wajib diisi.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kapasitas</label>
                <div class="input-group">
                    <input type="number" name="kapasitas" class="form-control" placeholder="Masukkan kapasitas ruang">
                    <span class="input-group-text">Orang</span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi ruang">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('ruang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
    }

    .card-header {
        font-size: 16px;
        padding: 12px 15px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
    }

    .btn-success {
        background: linear-gradient(45deg, #28a745, #218838);
        border: none;
    }

    .btn-success:hover {
        background: linear-gradient(45deg, #218838, #1e7e34);
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }
    }
</style>

<script>
    // Validasi Bootstrap
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
