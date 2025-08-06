<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor - SIRUBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="bg-light">

    @include('layouts.visitor_nav') <!-- Navbar khusus visitor -->

    <div class="container py-4">
        <!-- Grid 2x2 -->
        <div class="row g-4">
            <!-- Judul -->
            <div class="col-md-6">
                 <div class="card shadow-sm h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <!-- Judul dengan ikon -->
                        <h1 class="fw-bold">
                            SIRUBA
                        </h1>
                        <p class="text-muted">Sistem Informasi Ruang</p>
                        <h5 class="mt-2 text-primary">BAPPEDA</h5>
                        <p class="text-secondary mb-0">Kabupaten Temanggung</p>
                    </div>
                </div>
            </div>

            <!-- Peminjaman Berlangsung -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">Sedang Berlangsung</div>
                    <div class="card-body" id="ongoing-container">
                        @include('partials.visitor_ongoing', ['peminjamanBerlangsung' => $peminjamanBerlangsung])
                    </div>
                </div>
            </div>

            <!-- Peminjaman Mendatang -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-warning text-dark">Jadwal Mendatang</div>
                    <div class="card-body" id="upcoming-container">
                        @include('partials.visitor_upcoming', ['peminjamanMendatang' => $peminjamanMendatang])
                    </div>
                </div>
            </div>

            <!-- Riwayat Peminjaman -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-secondary text-white">Riwayat</div>
                    <div class="card-body" id="history-container">
                        @include('partials.visitor_history', ['peminjamanSelesai' => $peminjamanSelesai])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto Refresh Tiap 30 Detik
        setInterval(() => {
            fetch('{{ route('visitor.refresh') }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ongoing-container').innerHTML = data.ongoing;
                    document.getElementById('upcoming-container').innerHTML = data.upcoming;
                    document.getElementById('history-container').innerHTML = data.history;
                });
        }, 30000);
    </script>
</body>
</html>
