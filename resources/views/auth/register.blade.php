@extends('layouts.auth')

@section('title', 'Register | Perfume Store')

@section('content')
<div class="auth-page">
    <div class="auth-visual auth-visual-register">
        <div class="auth-copy">
            <p class="auth-kicker">New member</p>
            <h1>Create Your Account</h1>
            <p>
                Join sekarang buat dapetin diskon member, checkout lebih cepat,
                dan reward points setiap pembelian.
            </p>
        </div>

        <div class="auth-bottles">
            <img src="{{ asset('img/b7.png') }}" alt="Bottle">
            <img src="{{ asset('img/silver2.png') }}" alt="Silver Bottle">
        </div>
    </div>

    <div class="auth-card">
        <div class="auth-tabs">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="active">Register</a>
            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>

        <div class="auth-card-grid">
            <div>
                <h2>Register</h2>

                <form method="POST" action="{{ route('register.submit') }}" class="auth-form">
                    @csrf

                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
                    @error('name')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                    @error('email')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                    <label>Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    @error('phone')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimum 8 characters" required>
                    @error('password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Repeat password" required>

                    <label class="check-row">
                        <input type="checkbox" required>
                        <span>I agree to the Terms & Conditions</span>
                    </label>

                    <button type="submit" class="btn-auth">Register</button>

                    <p class="switch-text">
                        Already have an account?
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                </form>
            </div>

            <aside class="auth-sidebox">
                <h3>Why Join Perfume Store?</h3>
                <ul>
                    <li>Member exclusive discount</li>
                    <li>Faster checkout</li>
                    <li>Reward points tiap pembelian</li>
                    <li>Voucher dan benefit berikutnya</li>
                </ul>
            </aside>
        </div>
    </div>
</div>
@endsection