<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo / Judul -->
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
           <i class="bi bi-building text-primary me-2"></i> SIRUBA
        </a>

        <!-- Tombol Login -->
        <a href="{{ route('login') }}" class="btn btn-primary">
            Login
        </a>
    </div>
</nav>
