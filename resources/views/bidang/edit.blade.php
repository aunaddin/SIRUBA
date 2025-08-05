@extends('layouts.admin')

@section('title', 'Edit Bidang')
@section('header', 'Edit Bidang')

@section('content')
<form action="{{ route('bidang.update', $bidang) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Bidang</label>
        <input type="text" name="nama" class="form-control" value="{{ $bidang->nama }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('bidang.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
