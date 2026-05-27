<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $role = $request->query('role');

        /*
        |--------------------------------------------------------------------------
        | KPI
        |--------------------------------------------------------------------------
        */
        $totalUsers = User::count();

        $totalCustomers = User::where('role', 'user')->count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalPoints = User::sum('points_balance');


        /*
        |--------------------------------------------------------------------------
        | TABLE USERS
        |--------------------------------------------------------------------------
        */
        $users = User::withCount([
                'orders',
                'reviews',
                'userVouchers',
                'supportTickets',
            ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                });
            })
            ->when($role, function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact(
            'search',
            'role',
            'totalUsers',
            'totalCustomers',
            'totalAdmins',
            'totalPoints',
            'users'
        ));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:user,admin'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Proteksi admin tidak bisa menurunkan role dirinya sendiri
        |--------------------------------------------------------------------------
        */
        if (auth()->id() === $user->id && $validated['role'] === 'user') {
            return back()->with('error', 'Akun admin yang sedang digunakan tidak bisa diubah menjadi user.');
        }

        $user->update([
            'role' => $validated['role'],
        ]);

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}