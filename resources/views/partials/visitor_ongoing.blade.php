@if($peminjamanBerlangsung->isEmpty())
    <p class="text-muted text-center">Tidak ada peminjaman yang sedang berlangsung.</p>
@else
    <ul class="list-group">
        @foreach($peminjamanBerlangsung as $p)
            <li class="list-group-item">
                <strong>{{ $p->ruang->nama ?? 'Ruang tidak tersedia' }}</strong> - {{ $p->nama_acara }}<br>
                <small>{{ $p->bidang->nama ?? $p->bidang_manual ?? 'Bidang tidak tersedia' }} | {{ $p->jam_mulai }} - {{ $p->jam_selesai }}</small>
            </li>
        @endforeach
    </ul>
@endif
