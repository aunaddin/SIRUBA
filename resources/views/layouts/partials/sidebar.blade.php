<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="{{ url('/dashboard') }}" 
       class="brand-link text-center" 
       style="background: linear-gradient(135deg, #495057, #6c757d); display: block; padding: 12px;">
        <span class="brand-text font-weight-bold text-white" style="font-size: 1.6rem; letter-spacing: 1px;">
            SIRUBA
        </span>
    </a>

    <!-- Sub Bar -->
    <div class="text-center text-white py-2" style="background: #343a40; font-size: 0.9rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
        Sistem Informasi Ruang Bappeda
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-widget="treeview">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="font-size: 1.2rem;"></i>
                        <p class="ml-2">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/ruang') }}" class="nav-link">
                        <i class="nav-icon fas fa-door-open" style="font-size: 1.2rem;"></i>
                        <p class="ml-2">Ruang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/bidang') }}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase" style="font-size: 1.2rem;"></i>
                        <p class="ml-2">Bidang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/peminjaman') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check" style="font-size: 1.2rem;"></i>
                        <p class="ml-2">Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/peminjaman/history') }}" class="nav-link">
                        <i class="nav-icon fas fa-history" style="font-size: 1.2rem;"></i>
                        <p class="ml-2">Riwayat Peminjaman</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    /* Efek Hover Modern */
    .nav-sidebar .nav-link {
        transition: all 0.3s ease;
        border-radius: 6px;
        margin: 2px 5px;
    }

    .nav-sidebar .nav-link:hover {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: #fff !important;
        transform: translateX(3px);
    }

    .nav-sidebar .nav-link i {
        transition: transform 0.3s;
    }

    .nav-sidebar .nav-link:hover i {
        transform: scale(1.2);
    }

    /* Aktif menu */
    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: #fff !important;
    }
</style>
