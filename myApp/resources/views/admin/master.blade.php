<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    {{-- Select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Custom Style --}}
    <style>
        a {
            text-decoration: none;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #212529;
            color: #fff;
            position: fixed;
            top: 56px; /* height of navbar */
            left: 0;
            bottom: 0;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 999;
        }

        .sidebar a {
            color: #adb5bd;
            padding: 15px 25px;
            display: block;
            transition: all 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #343a40;
            color: #fff;
        }

        .sidebar.collapsed {
            width: 0;
            overflow: hidden;
        }

        .main-content {
            flex: 1;
            padding: 80px 20px 20px 20px;
            margin-left: 240px;
            transition: margin-left 0.3s;
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        .navbar {
            background-color: #212529;
            height: 56px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1001;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 5px 10px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        #toggleSidebarBtn {
            border: none;
            background: transparent;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                top: 56px;
                width: 240px;
                left: -240px;
                transition: left 0.3s;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0 !important;
                padding-top: 80px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Top Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid px-4">
            <button id="toggleSidebarBtn" class="me-3 text-white">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand fw-bold text-white" href="#">Poh Mal SMS Provider</a>
        </div>
    </nav>

    <div class="wrapper">
        
        <div class="sidebar" id="sidebar">
            @if(auth()->check() && auth()->user()->hasRole('admin'))
                <a href="/dashboard" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                <a href="/users"><i class="fas fa-users me-2"></i> Customers</a>
                <a href="/orders"><i class="fas fa-file-invoice me-2"></i> Orders</a>
                <a href="/logs"><i class="fas fa-list-ul me-2"></i> Logs</a>
            @endif

            @if(auth()->check() && auth()->user()->hasRole('user'))
                <a href="/user/dashboard" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                <a href="/user/orders"><i class="fas fa-file-invoice me-2"></i> Orders</a>
                <a href="/user/logs"><i class="fas fa-list-ul me-2"></i> Logs</a>
                <a href="/user/api"><i class="fas fa-code me-2"></i> API</a>
                <a href="/user/price"><i class="fas fa-tags me-2"></i> Price</a>
                <a href="/user/help"><i class="fas fa-question-circle me-2"></i> FAQs</a>
            @endif

            <a href="/change-password"><i class="fas fa-user-cog me-2"></i> Change Password</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

            <div class="sidebar-version text-center mt-auto py-3" style="font-size: 0.85rem; color: #868e96;">
                Beta Version 1.0.0
            </div>
        </div>

        <div class="main-content" id="main-content">
            @yield('content')
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function () {
            $('.datatable').DataTable();
            $('.select2').select2();

            $('#toggleSidebarBtn').on('click', function () {
                if (window.innerWidth <= 768) {
                    $('#sidebar').toggleClass('show');
                } else {
                    $('#sidebar').toggleClass('collapsed');
                    $('#main-content').toggleClass('collapsed');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
