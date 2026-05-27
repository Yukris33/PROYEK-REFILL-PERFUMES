<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'points_balance' => 0,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat.');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ], [
        'email.required' => 'Email wajib diisi.',
        'password.required' => 'Password wajib diisi.',
    ]);

    $remember = $request->boolean('remember');

    if (!Auth::attempt($credentials, $remember)) {
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    if (Auth::user()->role === 'admin') {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'email' => 'Akun admin harus login melalui form Login as Admin.',
        ])->onlyInput('email');
    }

    $request->session()->regenerate();

    return redirect()->intended(route('home'))->with('success', 'Login berhasil.');
}

public function adminLogin(Request $request)
{
    $validated = $request->validate([
        'admin_email' => ['required', 'email'],
        'admin_password' => ['required', 'string'],
    ], [
        'admin_email.required' => 'Email admin wajib diisi.',
        'admin_email.email' => 'Format email admin tidak valid.',
        'admin_password.required' => 'Password admin wajib diisi.',
    ]);

    $admin = User::where('email', $validated['admin_email'])
        ->where('role', 'admin')
        ->first();

    if (!$admin || !Hash::check($validated['admin_password'], $admin->password)) {
        return back()->withErrors([
            'admin_email' => 'Email admin atau password salah.',
        ])->onlyInput('admin_email');
    }

    Auth::login($admin);
    $request->session()->regenerate();

    return redirect('/admin/dashboard')
        ->with('success', 'Login admin berhasil.');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Berhasil logout.');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPassword(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}