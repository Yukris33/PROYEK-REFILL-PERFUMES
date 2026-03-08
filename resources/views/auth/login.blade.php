@extends('layouts.auth')

@section('title', 'Login | Perfume Store')

@section('content')
<div class="auth-page">
    <div class="auth-visual auth-visual-login">
        <div class="auth-copy">
            <p class="auth-kicker">Member access</p>
            <h1>Login &amp; Register</h1>
            <p>
                Welcome back. Masuk ke akun kamu untuk lanjut belanja, cek poin,
                dan simpan progress checkout.
            </p>
        </div>

        <div class="auth-bottles">
            <img src="{{ asset('img/ocean breeze fix.png') }}" alt="Ocean Breeze">
            <img src="{{ asset('img/velvet1.png') }}" alt="Velvet">
        </div>
    </div>

    <div class="auth-card">
        <div class="auth-tabs">
            <a href="{{ route('login') }}" class="active">Login</a>
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>

        <div class="auth-card-grid">
            <div>
                <h2>Login</h2>

                <form method="POST" action="{{ route('login.submit') }}" class="auth-form">
                    @csrf

                    <label>Email Address</label>
                    <div class="input-wrap">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        <i class="bi bi-person"></i>
                    </div>
                    @error('email')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                    <label>Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" placeholder="••••••••" required>
                        <i class="bi bi-lock"></i>
                    </div>
                    @error('password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                    <label class="check-row">
                        <input type="checkbox" name="remember">
                        <span>Remember Me</span>
                    </label>

                    <button type="submit" class="btn-auth">Login</button>

                    <p class="switch-text">
                        Don’t have an account?
                        <a href="{{ route('register') }}">Create Account</a>
                    </p>

                    <p class="switch-text">
                        Forgot your password?
                        <a href="{{ route('password.request') }}">Reset here</a>
                    </p>
                </form>
            </div>

            <aside class="auth-sidebox dark">
    <div class="shield-icon"><i class="bi bi-shield-lock"></i></div>
    <h3>Login as Admin</h3>

    <form action="#" method="POST" class="auth-form admin-form">
        @csrf

        <label>Admin ID</label>
        <input type="text" name="admin_id" placeholder="Enter admin ID">

        <label>Password</label>
        <div class="input-wrap">
            <input type="password" name="admin_password" placeholder="••••••••">
            <i class="bi bi-lock"></i>
        </div>

        <button type="submit" class="btn-auth btn-admin">Admin Login</button>
    </form>
</aside>
        </div>
    </div>
</div>
@endsection