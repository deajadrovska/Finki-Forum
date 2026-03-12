<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FINKI Forum')</title>
    <meta name="description" content="A forum for FINKI students to discuss subjects, threads, experiences, and resources">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header-inner">

            <a href="{{ route('home') }}" class="logo" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
                <img
                    src="{{ asset('images/forum-logo.png') }}"
                    alt="FINKI Forum Logo"
                    style="height:48px;width:auto;display:block;"
                >
                <span class="logo-text">FINKI Forum</span>
            </a>

            <nav class="nav-desktop">
                <a href="{{ route('home') }}" class="nav-link">
                    <i data-lucide="home" class="icon"></i> Home
                </a>

                <a href="{{ route('subjects.index') }}" class="nav-link">
                    <i data-lucide="book-open" class="icon"></i> Subjects
                </a>

                @if (Route::has('majors.index'))
                    <a href="{{ route('majors.index') }}" class="nav-link">
                        <i data-lucide="graduation-cap" class="icon"></i> Majors
                    </a>
                @else
                    <a href="#" class="nav-link">
                        <i data-lucide="message-square" class="icon"></i> Threads
                    </a>
                @endif
            </nav>

            <div class="header-search">
                <div class="input-with-icon">
                    <i data-lucide="search" class="input-icon icon"></i>
                    <input
                        type="search"
                        class="input"
                        placeholder="Search threads, subjects..."
                        style="background:var(--secondary);border-color:transparent;"
                    >
                </div>
            </div>

            <div class="header-actions">
                @auth
                    <a href="#" class="avatar avatar-md avatar-filled" style="text-decoration:none;">
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

<main class="container" style="padding-top:2rem;padding-bottom:2rem;">
    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <div class="footer-inner">
            <p>FINKI Forum - Faculty of Computer Science and Engineering</p>
        </div>
    </div>
</footer>

<script>
    lucide.createIcons();
</script>

</body>
</html>
