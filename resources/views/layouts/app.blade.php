<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD Universitas Suryakancana</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }
        #sidebar {
            width: 280px;
            height: 100vh;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid #e2e8f0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1050;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        #sidebar::-webkit-scrollbar {
            width: 4px;
        }
        #sidebar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        #content {
            width: 100%;
            padding-left: 280px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.25rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 0.6rem;
            margin: 0.25rem 1rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #f1f5f9;
            color: #0d6efd;
        }
        .sidebar-link i {
            margin-right: 0.8rem;
            font-size: 1.2rem;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 1.25rem;
            z-index: 1040;
        }
        #sidebar-overlay {
            display: none;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.2);
            z-index: 1045;
            top: 0;
            left: 0;
        }
        @media (max-width: 992px) {
            #sidebar { margin-left: -280px; }
            #content { padding-left: 0; }
            #sidebar.active { margin-left: 0; }
            #sidebar.active ~ #sidebar-overlay { display: block; }
        }
        /* Extra small devices tweaks */
        @media (max-width: 576px) {
            .navbar { padding: 0.5rem 1rem; }
            main { padding: 1rem !important; }
        }
        .card { border: none; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); }
        .rounded-4 { border-radius: 1rem !important; }
        .rounded-3 { border-radius: 0.75rem !important; }
        .badge { font-weight: 600; }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="p-4 mb-2">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 40px;">
                    <div class="overflow-hidden">
                        <h6 class="fw-bold mb-0 text-dark text-truncate" style="font-size: 14px;">SIAKAD</h6>
                        <small class="text-muted d-block text-truncate" style="font-size: 11px;">Universitas Suryakancana</small>
                    </div>
                </div>
            </div>
            
            <nav class="mt-2">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
                
                @if(auth()->user()->role == 'admin')
                    <div class="px-4 py-2 mt-3 small text-uppercase text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">Manajemen</div>
                    <a href="{{ route('dosen.index') }}" class="sidebar-link {{ request()->routeIs('dosen.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Data Dosen
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="sidebar-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Mahasiswa
                    </a>
                    <a href="{{ route('matakuliah.index') }}" class="sidebar-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i> Mata Kuliah
                    </a>
                    <a href="{{ route('jadwal.index') }}" class="sidebar-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar3"></i> Jadwal Kuliah
                    </a>
                    <a href="{{ route('krs.index') }}" class="sidebar-link {{ request()->routeIs('krs.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-check"></i> Kelola KRS
                    </a>
                @else
                    <div class="px-4 py-2 mt-3 small text-uppercase text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">Akademik</div>
                    <a href="{{ route('krs.index') }}" class="sidebar-link {{ request()->routeIs('krs.index') ? 'active' : '' }}">
                        <i class="bi bi-card-checklist"></i> KRS Saya
                    </a>
                    <a href="{{ route('jadwal.index') }}" class="sidebar-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event"></i> Jadwal Kuliah
                    </a>
                @endif

                <div class="px-4 py-2 mt-3 small text-uppercase text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">Akun</div>
                <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                    @csrf
                    <a href="#" class="sidebar-link text-danger" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </form>
            </nav>
        </div>

        <div id="sidebar-overlay"></div>

        <div id="content">
            <nav class="navbar sticky-top">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-light border-0 shadow-sm d-lg-none">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    
                    <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn border-0 d-flex align-items-center dropdown-toggle p-0 shadow-none" type="button" data-bs-toggle="dropdown">
                                <div class="text-end me-2 d-none d-sm-block">
                                    <div class="fw-bold small text-dark">{{ auth()->user()->name }}</div>
                                    <span class="badge bg-light text-primary border" style="font-size: 9px;">{{ strtoupper(auth()->user()->role) }}</span>
                                </div>
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; font-size: 14px;">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 rounded-3">
                                <li class="px-3 py-2 d-sm-none border-bottom mb-2">
                                    <div class="fw-bold small text-dark">{{ auth()->user()->name }}</div>
                                    <small class="text-muted">{{ strtoupper(auth()->user()->role) }}</small>
                                </li>
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="p-4 flex-grow-1">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </main>

            <footer class="p-4 text-center text-muted small border-top bg-white">
                &copy; {{ date('Y') }} Universitas Suryakancana. All rights reserved.
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
        document.getElementById('sidebar-overlay')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('active');
        });

        // Auto-close sidebar on window resize if it's open and screen becomes large
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) {
                document.getElementById('sidebar').classList.remove('active');
            }
        });
    </script>
</body>
</html>