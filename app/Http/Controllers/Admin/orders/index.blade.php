@extends('admin.layouts.app')

@section('title', 'Pesanan & Pembayaran - SCENTCYCLE')
@section('page_title', 'Pesanan & Pembayaran')

@section('content')

    {{-- =========================
        KPI PESANAN
    ========================== --}}
    <section class="admin-order-kpi-grid">

        <article class="admin-order-kpi-card">
            <span>Total Pesanan</span>
            <strong>{{ number_format($totalOrders, 0, ',', '.') }}</strong>
            <small>Seluruh order yang tercatat</small>
        </article>

        <article class="admin-order-kpi-card admin-order-kpi-card--success">
            <span>Pembayaran Paid</span>
            <strong>{{ number_format($paidOrders, 0, ',', '.') }}</strong>
            <small>Order yang sudah dibayar</small>
        </article>

        <article class="admin-order-kpi-card admin-order-kpi-card--warning">
            <span>Belum Dibayar</span>
            <strong>{{ number_format($unpaidOrders, 0, ',', '.') }}</strong>
            <small>Order dengan status unpaid</small>
        </article>

        <article class="admin-order-kpi-card admin-order-kpi-card--revenue">
            <span>Total Revenue</span>
            <strong>Rp{{ number_format($totalRevenue, 0, ',', '.') }}</strong>
            <small>Dari payment berstatus paid</small>
        </article>

    </section>


    {{-- =========================
        FILTER ORDER
    ========================== --}}
    <section class="admin-order-filter-card">
        <div class="admin-order-filter-head">
            <div>
                <span>Filter Transaksi</span>
                <h2>Cari dan pantau pesanan customer</h2>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.orders.index') }}" class="admin-order-filter-form">

            <div class="admin-order-filter-field admin-order-filter-field--search">
                <label for="search">Cari Pesanan</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    value="{{ $search }}"
                    placeholder="Kode transaksi, nama customer, atau email..."
                >
            </div>

            <div class="admin-order-filter-field">
                <label for="order_status">Status Pesanan</label>
                <select name="order_status" id="order_status">
                    <option value="">Semua</option>
                    <option value="pending" {{ $orderStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $orderStatus === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="processing" {{ $orderStatus === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $orderStatus === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $orderStatus === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="admin-order-filter-field">
                <label for="payment_status">Status Pembayaran</label>
                <select name="payment_status" id="payment_status">
                    <option value="">Semua</option>
                    <option value="unpaid" {{ $paymentStatus === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ $paymentStatus === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $paymentStatus === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ $paymentStatus === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            <div class="admin-order-filter-field">
                <label for="payment_method">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method">
                    <option value="">Semua</option>
                    @foreach($paymentMethods as $method)
                        <option value="{{ $method }}" {{ $paymentMethod === $method ? 'selected' : '' }}>
                            {{ $method }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="admin-order-filter-actions">
                <button type="submit" class="admin-order-btn admin-order-btn--primary">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>

                <a href="{{ route('admin.orders.index') }}" class="admin-order-btn admin-order-btn--ghost">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </div>

        </form>
    </section>


    {{-- =========================
        TABLE ORDER
    ========================== --}}
    <section class="admin-order-table-card">
        <div class="admin-order-table-head">
            <div>
                <span>Daftar Transaksi</span>
                <h2>Pesanan & Pembayaran Customer</h2>
            </div>

            <div class="admin-order-result-pill">
                {{ number_format($orders->total(), 0, ',', '.') }} data ditemukan
            </div>
        </div>

        <div class="admin-order-table-wrap">
            <table class="admin-order-table">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status Pesanan</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->order_code }}</strong>
                            </td>

                            <td>
                                <div class="admin-order-customer">
                                    <strong>{{ $order->customer_name ?? $order->user->name ?? 'Guest' }}</strong>
                                    <span>{{ $order->customer_email ?? $order->user->email ?? '-' }}</span>
                                </div>
                            </td>

                            <td>
                                {{ $order->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </td>

                            <td>
                                <strong>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</strong>
                            </td>

                            <td>
                                {{ $order->payment->method ?? '-' }}
                            </td>

                            <td>
                                <span class="admin-order-badge admin-order-badge--{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td>
                                <span class="admin-payment-badge admin-payment-badge--{{ $order->payment_status }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
    <a href="{{ route('admin.orders.show', $order) }}" class="admin-order-detail-btn">
        <i class="bi bi-eye"></i>
        Detail
    </a>
</td>

                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="admin-order-btn admin-order-btn--ghost">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="admin-order-empty">
                                    <i class="bi bi-inbox"></i>
                                    <strong>Belum ada data yang sesuai.</strong>
                                    <span>Coba ubah filter atau reset pencarian.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="admin-order-pagination">
                {{ $orders->links() }}
            </div>
        @endif
    </section>

@endsection