<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth | Perfume Store')</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-topbar">
            <div class="auth-flags">
                <img src="https://flagcdn.com/w40/id.png" alt="ID">
                <img src="https://flagcdn.com/w40/gb.png" alt="EN">
            </div>

            <div class="auth-back">
             <a href="{{ url('/') }}" class="back-home">
                ← Back to Home
            </a>
        </div>

            <a href="{{ route('home') }}" class="auth-brand">PERFUME STORE</a>

            <div class="auth-topbar-right">
                <a href="{{ route('cart.index') }}" class="auth-icon">
                    <i class="bi bi-bag"></i>
                    <span>({{ count(session('cart', [])) }})</span>
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        @if (session('status'))
            <div class="flash flash-success">{{ session('status') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>