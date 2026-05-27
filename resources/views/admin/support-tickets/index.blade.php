@extends('admin.layouts.app')

@section('title', 'Laporan Kendala - SCENTCYCLE')
@section('page_title', 'Laporan Kendala')

@section('content')

@if(session('success'))
    <div class="admin-module-alert admin-module-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<section class="admin-module-kpi-grid">
    <article class="admin-module-kpi-card">
        <span>Total Laporan</span>
        <strong>{{ number_format($totalTickets, 0, ',', '.') }}</strong>
        <small>Semua tiket kendala masuk</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Baru</span>
        <strong>{{ number_format($openTickets, 0, ',', '.') }}</strong>
        <small>Belum diproses admin</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Diproses</span>
        <strong>{{ number_format($inProgressTickets, 0, ',', '.') }}</strong>
        <small>Sedang ditangani</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Selesai</span>
        <strong>{{ number_format($resolvedTickets, 0, ',', '.') }}</strong>
        <small>Laporan yang sudah resolved</small>
    </article>
</section>

<section class="admin-module-filter-card">
    <div class="admin-module-head">
        <div>
            <span>Filter Laporan</span>
            <h2>Pantau keluhan dan bantuan customer</h2>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.support-tickets.index') }}" class="admin-module-filter-form">
        <div class="admin-module-field admin-module-field--search">
            <label>Cari Data</label>
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Nama user, email, subject, atau isi kendala..."
            >
        </div>

        <div class="admin-module-field">
            <label>Kategori</label>
            <select name="category">
                <option value="">Semua</option>
                <option value="mesin" {{ $category === 'mesin' ? 'selected' : '' }}>Mesin</option>
                <option value="transaksi" {{ $category === 'transaksi' ? 'selected' : '' }}>Transaksi</option>
                <option value="voucher" {{ $category === 'voucher' ? 'selected' : '' }}>Voucher</option>
                <option value="lainnya" {{ $category === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="admin-module-field">
            <label>Status</label>
            <select name="status">
                <option value="">Semua</option>
                <option value="open" {{ $status === 'open' ? 'selected' : '' }}>Baru</option>
                <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>Diproses</option>
                <option value="resolved" {{ $status === 'resolved' ? 'selected' : '' }}>Selesai</option>
                <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Ditutup</option>
            </select>
        </div>

        <div class="admin-module-filter-actions">
            <button type="submit" class="admin-module-btn admin-module-btn--primary">
                <i class="bi bi-funnel"></i>
                Terapkan
            </button>

            <a href="{{ route('admin.support-tickets.index') }}" class="admin-module-btn admin-module-btn--ghost">
                Reset
            </a>
        </div>
    </form>
</section>

<section class="admin-module-table-card">
    <div class="admin-module-table-head">
        <div>
            <span>Customer Support</span>
            <h2>Daftar Laporan Kendala</h2>
        </div>

        <div class="admin-module-pill">
            {{ number_format($tickets->total(), 0, ',', '.') }} laporan
        </div>
    </div>

    <div class="admin-module-table-wrap">
        <table class="admin-module-table admin-module-table--support">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Kategori</th>
                    <th>Subject & Detail</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Update Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>
                            <div class="admin-module-person">
                                <strong>{{ $ticket->user->name ?? 'Guest / Tidak Login' }}</strong>
                                <span>{{ $ticket->user->email ?? '-' }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="admin-module-badge admin-module-badge--category">
                                {{ strtoupper($ticket->category) }}
                            </span>
                        </td>

                        <td>
                            <div class="admin-module-description">
                                <strong>{{ $ticket->subject }}</strong>
                                <p>{{ $ticket->description }}</p>
                            </div>
                        </td>

                        <td>
                            <span class="admin-module-status admin-module-status--{{ $ticket->status }}">
                                @if($ticket->status === 'open')
                                    Baru
                                @elseif($ticket->status === 'in_progress')
                                    Diproses
                                @elseif($ticket->status === 'resolved')
                                    Selesai
                                @else
                                    Ditutup
                                @endif
                            </span>
                        </td>

                        <td>
                            {{ $ticket->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                        </td>

                        <td>
                            <form method="POST" action="{{ route('admin.support-tickets.update-status', $ticket) }}" class="admin-module-inline-form">
                                @csrf
                                @method('PATCH')

                                <select name="status">
                                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Baru</option>
                                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>Diproses</option>
                                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Selesai</option>
                                    <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Ditutup</option>
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
                            <div class="admin-module-empty">
                                <i class="bi bi-headset"></i>
                                <strong>Belum ada laporan kendala.</strong>
                                <span>Data yang dikirim customer akan tampil di sini.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($tickets->hasPages())
        <div class="admin-module-pagination">
            {{ $tickets->links() }}
        </div>
    @endif
</section>

@endsection