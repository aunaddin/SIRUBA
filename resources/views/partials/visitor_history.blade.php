@if($peminjamanSelesai->isEmpty())
    <p class="text-muted text-center">Belum ada riwayat peminjaman.</p>
@else
    <ul class="list-group">
        @foreach($peminjamanSelesai as $p)
            <li class="list-group-item">
                <strong>{{ $p->ruang->nama ?? 'Ruang tidak tersedia' }}</strong> - {{ $p->nama_acara }} <br>
                <small>
                    {{ $p->bidang->nama ?? $p->bidang_manual ?? 'Bidang tidak tersedia' }} |
                    📅 {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }} |
                    ⏰ {{ $p->jam_mulai }} - {{ $p->jam_selesai }} |
                    👥 {{ $p->jumlah_peserta ?? '-' }} Peserta
                </small>
            </li>
        @endforeach
    </ul>
@endif
