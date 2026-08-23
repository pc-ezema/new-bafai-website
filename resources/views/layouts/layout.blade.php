<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        /* ── Reset & Base ── */
        body {
            background: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            padding-top: 56px; /* space for fixed navbar */
        }

        /* ── Top Navbar ── */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .top-nav .brand {
            font-weight: 600;
            font-size: 1.1rem;
            color: #1e293b;
        }
        .top-nav .brand i {
            color: #4f46e5;
            margin-right: 0.5rem;
        }
        .top-nav .nav-links a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            transition: 0.2s;
        }
        .top-nav .nav-links a:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        /* ── Sidebar (off-canvas on mobile) ── */
        .sidebar {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            width: 220px;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            padding: 1.5rem 0;
            overflow-y: auto;
            z-index: 1020;
            transform: translateX(0);
            transition: transform 0.25s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
        }
        .sidebar .nav-link {
            color: #475569;
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            border-radius: 0;
            border-left: 3px solid transparent;
            transition: 0.15s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #f1f5f9;
            color: #0f172a;
            border-left-color: #4f46e5;
        }
        .sidebar .nav-link i {
            width: 1.5rem;
            text-align: center;
            color: #94a3b8;
        }
        .sidebar .nav-link:hover i {
            color: #4f46e5;
        }
        .sidebar .logout-btn {
            background: none;
            border: none;
            color: #ef4444;
            width: 100%;
            text-align: left;
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
            transition: 0.15s;
        }
        .sidebar .logout-btn:hover {
            background: #fef2f2;
            border-left-color: #ef4444;
        }

        /* ── Main Content ── */
        .main-content {
            margin-left: 220px;
            padding: 1.5rem;
        }

        .brand img {
            width: 100px;
        }
        @media (max-width: 768px) {
            .brand img {
                display: none;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }

        /* ── Stats Cards ── */
        .stats-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid #e9ecef;
            transition: 0.2s;
        }
        .stats-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }
        .stats-card .number {
            font-size: 1.8rem;
            font-weight: 600;
            color: #0f172a;
        }
        .stats-card .label {
            font-size: 0.85rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stats-card .icon {
            font-size: 2rem;
            opacity: 0.2;
            color: #4f46e5;
        }

        /* ── Toggle button (mobile) ── */
        .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #475569;
            padding: 0 0.5rem;
        }
        .toggle-sidebar:hover {
            color: #0f172a;
        }

        /* ── Misc ── */
        .list-group-item {
            border-left: none;
            border-right: none;
        }
        .list-group-item:first-child { border-top: none; }
        .list-group-item:last-child { border-bottom: none; }
    </style>
</head>
<body>

    <!-- ─── TOP NAVBAR ─── -->
    <nav class="top-nav">
        <div>
            <button class="toggle-sidebar d-md-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <span class="brand">
                <img src="{{ asset('assets/img/bafai-logo.png') }}" alt="BAFAI">
                Admin
            </span>
        </div>
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
            <a href="#"><i class="fas fa-user-circle me-1"></i> Profile</a>
        </div>
    </nav>

    <!-- ─── SIDEBAR ─── -->
    <aside class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users')}}">
                    <i class="fas fa-users me-2"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.blogs.index')}}">
                    <i class="fas fa-blog me-2"></i> Blogs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.resources.index')}}">
                    <i class="fas fa-file-alt me-2"></i> Resources
                </a>
            </li>
            <li class="nav-item"></li>
                <a class="nav-link" href="{{route('admin.discounts.index')}}">
                    <i class="fas fa-tags me-2"></i> Discounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.course-prices.index') }}">
                    <i class="fas fa-tags me-2"></i> Course Prices
                </a>
            </li>
            <li class="nav-item mt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- ─── MAIN CONTENT ─── -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- ─── SCRIPTS ─── -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        }
        // Close sidebar when clicking outside (on mobile)
        document.addEventListener('click', function(event) {
            const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
            if (!isClickInside && window.innerWidth <= 768) {
                sidebar.classList.remove('open');
            }
        });
    </script>
</body>
</html>