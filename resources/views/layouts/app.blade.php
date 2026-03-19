<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kaiju Universe Fan Wiki')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ku-bg:        #1e1e1e;
            --ku-surface:   #2a2a2a;
            --ku-border:    #3a3a3a;
            --ku-accent:    #FFC107;
            --ku-text:      #e0e0e0;
            --ku-muted:     #888;
            --ku-danger:    #dc3545;
        }

        body {
            background-color: var(--ku-bg);
            color: var(--ku-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar-ku {
            background-color: #111;
            border-bottom: 2px solid var(--ku-accent);
        }
        .navbar-ku .navbar-brand {
            color: var(--ku-accent) !important;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }
        .navbar-ku .nav-link {
            color: var(--ku-text) !important;
            font-weight: 500;
            transition: color .2s;
        }
        .navbar-ku .nav-link:hover,
        .navbar-ku .nav-link.active {
            color: var(--ku-accent) !important;
        }
        .navbar-ku .btn-ku-admin {
            background-color: var(--ku-accent);
            color: #111;
            font-weight: 700;
            border: none;
            border-radius: 4px;
            padding: 4px 12px;
        }
        .navbar-ku .btn-ku-admin:hover {
            background-color: #e0a800;
        }

        /* Cards */
        .card-ku {
            background-color: var(--ku-surface);
            border: 1px solid var(--ku-border);
            border-radius: 8px;
        }
        .card-ku .card-title { color: var(--ku-accent); }

        /* Buttons */
        .btn-ku {
            background-color: var(--ku-accent);
            color: #111;
            font-weight: 700;
            border: none;
        }
        .btn-ku:hover { background-color: #e0a800; color: #111; }

        /* Forms */
        .form-control, .form-select {
            background-color: var(--ku-surface);
            border-color: var(--ku-border);
            color: var(--ku-text);
        }
        .form-control:focus, .form-select:focus {
            background-color: var(--ku-surface);
            border-color: var(--ku-accent);
            color: var(--ku-text);
            box-shadow: 0 0 0 .2rem rgba(255, 193, 7, .25);
        }
        .form-control::placeholder { color: var(--ku-muted); }

        /* Alert */
        .alert-ku-success {
            background-color: #1a3a1a;
            border-color: #2d6a2d;
            color: #6fcf6f;
        }
        .alert-ku-error {
            background-color: #3a1a1a;
            border-color: #6a2d2d;
            color: #cf6f6f;
        }

        /* Footer */
        footer {
            background-color: #111;
            border-top: 1px solid var(--ku-border);
            color: var(--ku-muted);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--ku-bg); }
        ::-webkit-scrollbar-thumb { background: var(--ku-border); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--ku-accent); }

        /* Tables */
        .table-dark-ku {
            --bs-table-bg: var(--ku-surface);
            --bs-table-border-color: var(--ku-border);
            color: var(--ku-text);
        }

        /* Breadcrumb */
        .breadcrumb-item a { color: var(--ku-accent); }
        .breadcrumb-item.active { color: var(--ku-muted); }
        .breadcrumb-item + .breadcrumb-item::before { color: var(--ku-muted); }
    </style>

    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-ku sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-tornado me-1"></i> KU Fan Wiki
        </a>
        <button class="navbar-toggler border-secondary" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('wiki.*') ? 'active' : '' }}"
                       href="{{ route('wiki.index') }}">Wiki</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}"
                       href="{{ route('events.index') }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}"
                       href="{{ route('blog.index') }}">Blog</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center gap-2">
                @auth
                    @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="btn-ku-admin">
                            <i class="bi bi-shield-fill me-1"></i>Admin
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end"
                            style="background-color:#2a2a2a; border-color:#3a3a3a;">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-ku btn-sm" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Flash messages -->
<div class="container">
    @if(session('success'))
        <div class="alert alert-ku-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-ku-error alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-ku-error alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<!-- Page content -->
<main class="pt-0 pb-4">
    @yield('content')
</main>

<!-- Footer -->
<footer class="py-4 mt-5 text-center">
    <div class="container">
        <p class="mb-0">
            <i class="bi bi-tornado me-1" style="color:var(--ku-accent)"></i>
            <strong style="color:var(--ku-accent)">Kaiju Universe Fan Wiki</strong>
            &mdash; Fan-made resource. Not affiliated with the official game.
        </p>
        <small class="text-secondary">&copy; {{ date('Y') }} KU Fan Wiki</small>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

@stack('scripts')
</body>
</html>
