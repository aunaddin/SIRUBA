@extends('layouts.admin')

@section('title', 'Tambah Bidang')
@section('header', 'Tambah Bidang')

@section('content')
<form action="{{ route('bidang.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Bidang</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('bidang.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
