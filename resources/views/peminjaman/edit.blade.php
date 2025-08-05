@extends('layouts.admin')

@section('header', 'Edit Peminjaman')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Peminjaman</h5>
    </div>
    <div class="card-body">

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bidang" class="form-label"><i class="fas fa-briefcase me-1"></i> Bidang</label>
                        <select name="bidang_id" id="bidang" class="form-control">
                            <option value="">Pilih Bidang</option>
                            @foreach($bidangs as $bidang)
                                <option value="{{ $bidang->id }}" 
                                    {{ old('bidang_id', $peminjaman->bidang_id) == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama }}
                                </option>
                            @endforeach
                            <option value="lainnya" 
                                {{ old('bidang_id', $peminjaman->bidang_manual ? 'lainnya' : '') == 'lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>
                    </div>

                    <div class="mb-3" id="bidang_manual_container" 
                        style="{{ old('bidang_id', $peminjaman->bidang_manual ? 'lainnya' : '') == 'lainnya' ? '' : 'display:none;' }}">
                        <label for="bidang_manual" class="form-label"><i class="fas fa-pen me-1"></i> Bidang (Manual)</label>
                        <input type="text" name="bidang_manual" class="form-control" 
                            value="{{ old('bidang_manual', $peminjaman->bidang_manual) }}">
                    </div>

                    <div class="mb-3">
                        <label for="ruang_id" class="form-label"><i class="fas fa-door-open me-1"></i> Ruang</label>
                        <select name="ruang_id" class="form-control" required>
                            @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->id }}" 
                                    {{ old('ruang_id', $peminjaman->ruang_id) == $ruang->id ? 'selected' : '' }}>
                                    {{ $ruang->nama }} (Kapasitas: {{ $ruang->kapasitas }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-calendar-day me-1"></i> Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" 
                            value="{{ old('tanggal', $peminjaman->tanggal) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-users me-1"></i> Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" class="form-control" 
                            value="{{ old('jumlah_peserta', $peminjaman->jumlah_peserta) }}" required>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-clock me-1"></i> Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" 
                            value="{{ old('jam_mulai', $peminjaman->jam_mulai) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-clock me-1"></i> Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" 
                            value="{{ old('jam_selesai', $peminjaman->jam_selesai) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-bullhorn me-1"></i> Nama Acara</label>
                        <input type="text" name="nama_acara" class="form-control" 
                            value="{{ old('nama_acara', $peminjaman->nama_acara) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user-tie me-1"></i> Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" class="form-control" 
                            value="{{ old('penanggung_jawab', $peminjaman->penanggung_jawab) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-sticky-note me-1"></i> Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $peminjaman->keterangan) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Perbarui</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('bidang').addEventListener('change', function() {
        document.getElementById('bidang_manual_container').style.display =
            this.value === 'lainnya' ? 'block' : 'none';
    });
</script>
@endsection
