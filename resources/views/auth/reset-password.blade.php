@extends('layouts.auth')

@section('title', 'Reset Password | Perfume Store')

@section('content')
<div class="auth-page single">
    <div class="auth-card narrow">
        <div class="auth-tabs">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('password.request') }}" class="active">Forgot Password?</a>
        </div>

        <div>
            <h2>Reset Password</h2>
            <p class="forgot-copy">
                Masukkan email dan password baru kamu.
            </p>

            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email', $email) }}" required>
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror

                <label>New Password</label>
                <input type="password" name="password" placeholder="Minimum 8 characters" required>
                @error('password')
                    <small class="error-text">{{ $message }}</small>
                @enderror

                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" placeholder="Repeat password" required>

                <button type="submit" class="btn-auth">Reset Password</button>

                <p class="switch-text">
                    Back to <a href="{{ route('login') }}">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection