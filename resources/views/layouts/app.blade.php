<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frozeria Stok</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #f0f4f8; }

        /* Card stat */
        .card-stat { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .card-stat .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }

        /* Card umum */
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }

        /* Tabel */
        .table thead th { background-color: #f8fafc; color: #64748b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; padding: 12px 16px; } /*Header*/
        .table tbody td { padding: 12px 16px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; } /*Baris*/
        .table tbody tr:hover { background-color: #f8fafc; }
        .table tbody tr:last-child td { border-bottom: none; }

        /* Badge kategori */
        .badge-kategori { font-size: 0.72rem; padding: 4px 10px; border-radius: 20px; font-weight: 500; }

        /* Tombol aksi */
        .btn-aksi { font-size: 0.78rem; padding: 4px 12px; border-radius: 6px; font-weight: 500; }

        /* Fix input group focus border */
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #86b7fe;
            box-shadow: none;
        }
        .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-radius: 6px;
        }
        .input-group .form-control:focus {
            box-shadow: none;
        }

        /* Pagination */
        .pagination {
            margin-bottom: 0;
            gap: 4px;
        }
        .pagination .page-link {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0;
            color: #334155;
            font-size: 0.85rem;
            padding: 6px 12px;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #94a3b8;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #1a1a2e, #16213e);">
        <div class="container-fluid px-4">

            {{-- Brand --}}
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('barang.index') }}">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width:36px; height:36px; background: #0d6efd;">
                    <i class="bi bi-snow text-white"></i>
                </div>
                <div>
                    <span style="font-weight:800; font-size:1.1rem; color:white;">Frozeria</span>
                    <span style="font-weight:300; font-size:1.1rem; color:#90caf9;"> Stok</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-4 gap-1">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('barang.*') ? 'active fw-semibold' : '' }}"
                        style="{{ request()->routeIs('barang.*') ? 'background:rgba(255,255,255,0.15);' : '' }}"
                        href="{{ route('barang.index') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('kategori.*') ? 'active fw-semibold' : '' }}"
                        style="{{ request()->routeIs('kategori.*') ? 'background:rgba(255,255,255,0.15);' : '' }}"
                        href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags me-1"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('bantuan') ? 'active fw-semibold' : '' }}"
                        style="{{ request()->routeIs('bantuan') ? 'background:rgba(255,255,255,0.15);' : '' }}"
                        href="{{ route('bantuan') }}">
                            <i class="bi bi-question-circle me-1"></i> Bantuan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container-fluid py-4 px-4">

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>