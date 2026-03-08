@extends('layouts.auth')

@section('title', 'Forgot Password | Perfume Store')

@section('content')
<div class="auth-page single">
    <div class="auth-card narrow">
        <div class="auth-tabs">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('password.request') }}" class="active">Forgot Password?</a>
        </div>

        <div>
            <h2>Forgot Password</h2>
            <p class="forgot-copy">
                Masukkan email akun kamu. Link reset password akan dikirim ke email.
            </p>

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf

                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror

                <button type="submit" class="btn-auth">Send Reset Link</button>

                <p class="switch-text">
                    Back to <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection