<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EMIRA')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #08C195;
            --primary-dark: #06a37b;
            --primary-light: #0ed6a8;
            --primary-subtle: rgba(8, 193, 149, 0.1);
            --secondary: #6366f1;
            --dark: #1e293b;
            --gray: #64748b;
            --light: #f8fafc;
            --border: #e2e8f0;
            --white: #ffffff;
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --sidebar-width: 280px;
        }
        
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f1f5f9; }
        
        /* Buttons */
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); }
        
        /* Cards */
        .card { border: none; border-radius: 0.75rem; box-shadow: var(--shadow); }
        .card:hover { box-shadow: var(--shadow-md); }
        
        /* Form Controls */
        .form-control, .form-select {
            border: 2px solid var(--border);
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-subtle);
        }
        
        /* Tables */
        .table thead th {
            background: var(--light);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: var(--gray);
        }
        
        /* Badges */
        .badge { font-weight: 500; }
        
        /* Layout */
        .wrapper { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-brand h4 {
            color: var(--white);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-user {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-user-avatar {
            width: 72px;
            height: 72px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            font-size: 1.5rem;
            color: var(--white);
            font-weight: 700;
            border: 3px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
        }
        
        .sidebar-user-avatar:hover {
            transform: scale(1.05);
            border-color: rgba(255,255,255,0.5);
        }
        
        .sidebar-user-name {
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        
        .sidebar-user-role {
            background: rgba(255,255,255,0.2);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }
        
        .sidebar-menu::-webkit-scrollbar { width: 4px; }
        .sidebar-menu::-webkit-scrollbar-track { background: rgba(255,255,255,0.1); }
        .sidebar-menu::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 2px; }
        
        .menu-section-title {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 1rem 1.5rem 0.5rem;
            font-weight: 600;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            font-weight: 500;
            text-decoration: none;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: var(--white);
            padding-left: 1.75rem;
        }
        
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: var(--white);
            border-left-color: var(--white);
            font-weight: 600;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }
        
        .nav-link-logout {
            color: #fca5a5 !important;
        }
        .nav-link-logout:hover {
            background: rgba(239, 68, 68, 0.2) !important;
            color: #fca5a5 !important;
        }
        
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-footer-text {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 1.5rem;
            min-height: 100vh;
        }
        
        /* Top Bar */
        .top-bar {
            background: var(--white);
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-bar-left {
            display: flex;
            align-items: center;
        }
        
        .top-bar-left h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }
        
        .top-bar-left p {
            color: var(--gray);
            font-size: 0.875rem;
            margin: 0;
        }
        
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .search-box { position: relative; }
        .search-box input {
            padding-left: 2.5rem;
            border-radius: 0.5rem;
            width: 250px;
        }
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--light);
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .user-menu:hover { background: var(--border); }
        
        .user-menu-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .user-menu-info { display: none; }
        
        @media (min-width: 992px) {
            .user-menu-info { display: block; }
        }
        
        .user-menu-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--dark);
            line-height: 1.2;
        }
        
        .user-menu-role {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        
        /* Stat Cards */
        .stat-card {
            border-radius: 0.75rem;
            transition: all 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .stat-icon-primary { background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; }
        .stat-icon-secondary { background: linear-gradient(135deg, var(--secondary), #818cf8); color: white; }
        .stat-icon-warning { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; }
        .stat-icon-danger { background: linear-gradient(135deg, #ef4444, #f87171); color: white; }
        .stat-icon-success { background: linear-gradient(135deg, #10b981, #34d399); color: white; }
        
        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            background: var(--primary);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            font-size: 1.25rem;
        }
        
        @media (max-width: 991.98px) {
            .mobile-toggle { display: flex; align-items: center; justify-content: center; }
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .sidebar-overlay.show { display: block; }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Custom Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-top: 1px solid var(--border);
        }
        
        .pagination-info {
            color: var(--gray);
            font-size: 0.875rem;
        }
        
        .pagination-info strong {
            color: var(--dark);
        }
        
        .pagination {
            margin: 0;
            gap: 0.25rem;
        }
        
        .page-item .page-link {
            border: none;
            padding: 0.5rem 0.875rem;
            border-radius: 0.5rem;
            color: var(--gray);
            font-weight: 500;
            font-size: 0.875rem;
            background: transparent;
            transition: all 0.2s;
        }
        
        .page-item .page-link:hover {
            background: var(--primary-subtle);
            color: var(--primary);
        }
        
        .page-item.active .page-link {
            background: var(--primary);
            color: white;
            box-shadow: 0 2px 8px rgba(8, 193, 149, 0.3);
        }
        
        .page-item.disabled .page-link {
            background: transparent;
            color: #cbd5e1;
            cursor: not-allowed;
        }
        
        .page-item .page-link i {
            font-size: 0.75rem;
        }
        
        .page-item:first-child .page-link,
        .page-item:last-child .page-link {
            padding: 0.5rem 1rem;
        }
        
        /* Pagination container style */
        .pagination-container {
            display: flex;
            justify-content: center;
        }
        
        /* Summary pagination style */
        .dataTables_paginate {
            margin-top: 1rem !important;
        }
        
        .dataTables_paginate .pagination {
            display: flex;
            gap: 0.25rem;
        }
        
        .dataTables_paginate .paginate_button {
            border: none !important;
            padding: 0.5rem 0.875rem !important;
            border-radius: 0.5rem !important;
            color: var(--gray) !important;
            font-weight: 500 !important;
            margin: 0 2px !important;
        }
        
        .dataTables_paginate .paginate_button:hover {
            background: var(--primary-subtle) !important;
            color: var(--primary) !important;
        }
        
        .dataTables_paginate .current {
            background: var(--primary) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(8, 193, 149, 0.3);
        }
    </style>
    @include('partials.ui-components')
    @yield('styles')
</head>
<body>
    @auth
    <div class="wrapper">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
        
        <!-- Sidebar -->
        @include('partials.sidebar')
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            @include('partials.topbar')
            
            <!-- Page Content -->
            @yield('content')
        </main>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
    @else
    @yield('content')
    @endauth

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session("success") }}', timer: 3000, showConfirmButton: false });
        @endif
        @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Gagal', text: '{{ session("error") }}', timer: 3000, showConfirmButton: false });
        @endif
        $(document).ready(function() {
            $('.select2').select2({ theme: 'bootstrap-5' });
            $('.table[data-datatable]').each(function() {
                $(this).DataTable({
                    language: { url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/id.json' },
                    ordering: true,
                    paging: true,
                    info: true,
                    searchDelay: 350
                });
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
