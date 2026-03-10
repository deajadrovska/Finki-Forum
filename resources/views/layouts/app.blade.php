<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'FINKI Forum')</title>

    <meta name="description" content="A web forum for FINKI students to discuss subjects, share resources, and connect with peers">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body>

<!-- HEADER -->
<header class="header">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">
                    <i data-lucide="graduation-cap" class="icon-md"></i>
                </div>
                <span class="logo-text">FINKI Forum</span>
            </a>

            <!-- Navigation -->
            <nav class="nav-desktop">
                <a href="{{ route('home') }}" class="nav-link">
                    <i data-lucide="home" class="icon"></i> Home
                </a>

                <a href="{{ route('subjects.index') }}" class="nav-link">
                    <i data-lucide="book-open" class="icon"></i> Subjects
                </a>
            </nav>

            <!-- Search -->
            <div class="header-search">
                <div class="input-with-icon">
                    <i data-lucide="search" class="input-icon icon"></i>
                    <input type="search" class="input"
                           placeholder="Search threads, subjects..."
                           style="background:var(--secondary);border-color:transparent;">
                </div>
            </div>

            <!-- Actions -->
            <div class="header-actions">

                @auth
                    @if (Route::has('threads.create'))
                        <a href="{{ route('threads.create') }}" class="btn btn-primary btn-sm">
                            <i data-lucide="plus" class="icon-sm"></i> New Thread
                        </a>
                    @endif

                    <a href="#" class="avatar avatar-md avatar-filled">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                    @endif
                @endauth

            </div>
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->
<main class="container" style="padding-top:2rem;padding-bottom:2rem;">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-inner">
            <p>FINKI Forum - Faculty of Computer Science and Engineering</p>

            <div class="footer-links">
                <a href="#">Guidelines</a>
                <a href="#">Help</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </div>
</footer>

<script>
    lucide.createIcons();
</script>

</body>
</html>
