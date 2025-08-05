@if($peminjamanMendatang->isEmpty())
    <p class="text-muted text-center">Tidak ada jadwal mendatang.</p>
@else
    <ul class="list-group">
        @foreach($peminjamanMendatang as $p)
            <li class="list-group-item">
                <strong>{{ $p->ruang->nama ?? 'Ruang tidak tersedia' }}</strong> - {{ $p->nama_acara }}<br>
                <small>{{ $p->bidang->nama ?? $p->bidang_manual ?? 'Bidang tidak tersedia' }} | {{ $p->tanggal }} | {{ $p->jam_mulai }} - {{ $p->jam_selesai }}</small>
            </li>
        @endforeach
    </ul>
@endif
