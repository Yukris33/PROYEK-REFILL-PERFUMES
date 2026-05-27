@extends('admin.layouts.app')

@section('title', 'Pengguna - SCENTCYCLE')
@section('page_title', 'Pengguna')

@section('content')

@if(session('success'))
    <div class="admin-user-alert admin-user-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="admin-user-alert admin-user-alert--error">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Gagal</strong>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif


{{-- ===============================
    KPI
================================ --}}
<section class="admin-user-kpi-grid">

    <article class="admin-user-kpi-card">
        <span>Total Pengguna</span>
        <strong>{{ number_format($totalUsers, 0, ',', '.') }}</strong>
        <small>Seluruh akun terdaftar</small>
    </article>

    <article class="admin-user-kpi-card">
        <span>Total Customer</span>
        <strong>{{ number_format($totalCustomers, 0, ',', '.') }}</strong>
        <small>Akun dengan role user</small>
    </article>

    <article class="admin-user-kpi-card">
        <span>Total Admin</span>
        <strong>{{ number_format($totalAdmins, 0, ',', '.') }}</strong>
        <small>Akun pengelola sistem</small>
    </article>

    <article class="admin-user-kpi-card">
        <span>Total Poin User</span>
        <strong>{{ number_format($totalPoints, 0, ',', '.') }}</strong>
        <small>Akumulasi poin semua akun</small>
    </article>

</section>


{{-- ===============================
    FILTER
================================ --}}
<section class="admin-user-filter-card">
    <div class="admin-user-head">
        <div>
            <span>User Monitoring</span>
            <h2>Kelola dan pantau akun SCENTCYCLE</h2>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="admin-user-filter-form">

        <div class="admin-user-field admin-user-field--search">
            <label for="search">Cari Pengguna</label>
            <input
                type="text"
                id="search"
                name="search"
                value="{{ $search }}"
                placeholder="Cari nama, email, atau nomor telepon..."
            >
        </div>

        <div class="admin-user-field">
            <label for="role">Filter Role</label>
            <select name="role" id="role">
                <option value="">Semua Role</option>
                <option value="user" {{ $role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="admin-user-filter-actions">
            <button type="submit" class="admin-user-btn admin-user-btn--primary">
                <i class="bi bi-funnel"></i>
                Terapkan Filter
            </button>

            <a href="{{ route('admin.users.index') }}" class="admin-user-btn admin-user-btn--ghost">
                Reset
            </a>
        </div>

    </form>
</section>


{{-- ===============================
    TABLE USERS
================================ --}}
<section class="admin-user-table-card">

    <div class="admin-user-table-head">
        <div>
            <span>Account Directory</span>
            <h2>Daftar Pengguna</h2>
        </div>

        <div class="admin-user-pill">
            {{ number_format($users->total(), 0, ',', '.') }} akun
        </div>
    </div>

    <div class="admin-user-table-wrap">
        <table class="admin-user-table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Saldo Poin</th>
                    <th>Ringkasan Aktivitas</th>
                    <th>Tanggal Daftar</th>
                    <th>Ubah Role</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>

                        <td>
                            <div class="admin-user-profile-cell">
                                <div class="admin-user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div>
                                    <strong>{{ $user->name }}</strong>
                                    <span>{{ $user->email }}</span>
                                    <small>{{ $user->phone ?? '-' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="admin-user-role admin-user-role--{{ $user->role }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>

                        <td>
                            <strong class="admin-user-points">
                                {{ number_format($user->points_balance, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            <div class="admin-user-activity-pills">
                                <span>Order <b>{{ $user->orders_count }}</b></span>
                                <span>Review <b>{{ $user->reviews_count }}</b></span>
                                <span>Voucher <b>{{ $user->user_vouchers_count }}</b></span>
                                <span>Kendala <b>{{ $user->support_tickets_count }}</b></span>
                            </div>
                        </td>

                        <td>
                            {{ $user->created_at?->timezone('Asia/Jakarta')->format('d M Y') }}
                        </td>

                        <td>
                            <form method="POST"
                                  action="{{ route('admin.users.update-role', $user) }}"
                                  class="admin-user-role-form">
                                @csrf
                                @method('PATCH')

                                <select name="role">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>

                                <button type="submit">
                                    Simpan
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="admin-user-empty">
                                <i class="bi bi-people"></i>
                                <strong>Tidak ada pengguna yang ditemukan.</strong>
                                <span>Coba ubah kata kunci pencarian atau filter role.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="admin-user-pagination">
            {{ $users->links() }}
        </div>
    @endif

</section>

@endsection