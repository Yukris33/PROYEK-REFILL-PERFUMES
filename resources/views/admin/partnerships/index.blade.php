@extends('admin.layouts.app')

@section('title', 'Kerja Sama - SCENTCYCLE')
@section('page_title', 'Kerja Sama')

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
        <span>Total Request</span>
        <strong>{{ number_format($totalRequests, 0, ',', '.') }}</strong>
        <small>Semua permintaan kerja sama</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Baru</span>
        <strong>{{ number_format($newRequests, 0, ',', '.') }}</strong>
        <small>Belum ditinjau</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Ditinjau</span>
        <strong>{{ number_format($reviewedRequests, 0, ',', '.') }}</strong>
        <small>Sudah masuk review admin</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Dihubungi</span>
        <strong>{{ number_format($contactedRequests, 0, ',', '.') }}</strong>
        <small>Pengaju sudah di-follow up</small>
    </article>
</section>

<section class="admin-module-filter-card">
    <div class="admin-module-head">
        <div>
            <span>Filter Partnership</span>
            <h2>Kelola peluang kolaborasi SCENTCYCLE</h2>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.partnerships.index') }}" class="admin-module-filter-form admin-module-filter-form--partnership">
        <div class="admin-module-field admin-module-field--search">
            <label>Cari Data</label>
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Nama, email, bisnis, nomor HP, atau isi pesan..."
            >
        </div>

        <div class="admin-module-field">
            <label>Status</label>
            <select name="status">
                <option value="">Semua</option>
                <option value="new" {{ $status === 'new' ? 'selected' : '' }}>Baru</option>
                <option value="reviewed" {{ $status === 'reviewed' ? 'selected' : '' }}>Ditinjau</option>
                <option value="contacted" {{ $status === 'contacted' ? 'selected' : '' }}>Dihubungi</option>
                <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Ditutup</option>
            </select>
        </div>

        <div class="admin-module-filter-actions">
            <button type="submit" class="admin-module-btn admin-module-btn--primary">
                <i class="bi bi-funnel"></i>
                Terapkan
            </button>

            <a href="{{ route('admin.partnerships.index') }}" class="admin-module-btn admin-module-btn--ghost">
                Reset
            </a>
        </div>
    </form>
</section>

<section class="admin-module-table-card">
    <div class="admin-module-table-head">
        <div>
            <span>Collaboration Pipeline</span>
            <h2>Permintaan Kerja Sama Masuk</h2>
        </div>

        <div class="admin-module-pill">
            {{ number_format($partnerships->total(), 0, ',', '.') }} request
        </div>
    </div>

    <div class="admin-module-table-wrap">
        <table class="admin-module-table admin-module-table--partnership">
            <thead>
                <tr>
                    <th>Pengaju</th>
                    <th>Bisnis</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Update Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($partnerships as $partnership)
                    <tr>
                        <td>
                            <div class="admin-module-person">
                                <strong>{{ $partnership->name }}</strong>
                                <span>{{ $partnership->email }}</span>
                                <small>{{ $partnership->phone ?? '-' }}</small>
                            </div>
                        </td>

                        <td>
                            <strong>{{ $partnership->business_name ?? '-' }}</strong>
                        </td>

                        <td>
                            <div class="admin-module-message">
                                {{ $partnership->message }}
                            </div>
                        </td>

                        <td>
                            <span class="admin-module-status admin-module-status--{{ $partnership->status }}">
                                @if($partnership->status === 'new')
                                    Baru
                                @elseif($partnership->status === 'reviewed')
                                    Ditinjau
                                @elseif($partnership->status === 'contacted')
                                    Dihubungi
                                @else
                                    Ditutup
                                @endif
                            </span>
                        </td>

                        <td>
                            {{ $partnership->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                        </td>

                        <td>
                            <form method="POST" action="{{ route('admin.partnerships.update-status', $partnership) }}" class="admin-module-inline-form">
                                @csrf
                                @method('PATCH')

                                <select name="status">
                                    <option value="new" {{ $partnership->status === 'new' ? 'selected' : '' }}>Baru</option>
                                    <option value="reviewed" {{ $partnership->status === 'reviewed' ? 'selected' : '' }}>Ditinjau</option>
                                    <option value="contacted" {{ $partnership->status === 'contacted' ? 'selected' : '' }}>Dihubungi</option>
                                    <option value="closed" {{ $partnership->status === 'closed' ? 'selected' : '' }}>Ditutup</option>
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
                                <i class="bi bi-handshake"></i>
                                <strong>Belum ada permintaan kerja sama.</strong>
                                <span>Pengajuan dari halaman customer akan muncul di sini.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($partnerships->hasPages())
        <div class="admin-module-pagination">
            {{ $partnerships->links() }}
        </div>
    @endif
</section>

@endsection