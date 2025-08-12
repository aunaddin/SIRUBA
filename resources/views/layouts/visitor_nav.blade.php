<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo / Judul -->
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" 
            alt="Logo" 
            class="brand-image img-circle elevation-3 rounded-circle" 
            style="opacity: .8; width:40px; height:40px; object-fit:cover;">
            SIRUBA
        </a>

        <!-- Tombol Login -->
        <a href="{{ route('login') }}" class="btn btn-primary">
            Login
        </a>
    </div>
</nav>
