@extends('admin.layouts.app')

@section('title', 'Detail Pesanan - SCENTCYCLE')
@section('page_title', 'Detail Pesanan')

@section('content')

    <section class="admin-order-detail-hero">
        <div>
            <span class="admin-order-detail-eyebrow">Order Detail</span>
            <h2>{{ $order->order_code }}</h2>
            <p>
                Dibuat pada
                {{ $order->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="admin-order-back-btn">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Pesanan
        </a>
    </section>

    <section class="admin-order-detail-grid">

        <article class="admin-order-detail-card">
    <div class="admin-order-detail-card__head">
        <span>Status Monitoring</span>
        <h3>Kelola Status</h3>
    </div>

    @if(session('success'))
        <div class="admin-order-update-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-order-status-stack admin-order-status-stack--current">
        <div>
            <span>Status Order Saat Ini</span>
            <strong class="admin-order-badge admin-order-badge--{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </strong>
        </div>

        <div>
            <span>Status Pembayaran Saat Ini</span>
            <strong class="admin-payment-badge admin-payment-badge--{{ $order->payment_status }}">
                {{ ucfirst($order->payment_status) }}
            </strong>
        </div>
    </div>

    <form
        action="{{ route('admin.orders.update-status', $order) }}"
        method="POST"
        class="admin-order-status-form"
    >
        @csrf
        @method('PATCH')

        <div class="admin-order-status-field">
            <label for="status">Ubah Status Pesanan</label>
            <select name="status" id="status" required>
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                    Processing
                </option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                    Completed
                </option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>
            </select>
            @error('status')
                <small class="admin-form-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="admin-order-status-field">
            <label for="payment_status">Ubah Status Pembayaran</label>
            <select name="payment_status" id="payment_status" required>
                <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>
                    Unpaid
                </option>
                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>
                    Paid
                </option>
                <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>
                    Failed
                </option>
                <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>
                    Refunded
                </option>
            </select>
            @error('payment_status')
                <small class="admin-form-error">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="admin-order-update-btn">
            <i class="bi bi-save"></i>
            Simpan Perubahan
        </button>
    </form>
</article>

        <article class="admin-order-detail-card">
            <div class="admin-order-detail-card__head">
                <span>Status Monitoring</span>
                <h3>Status Pesanan</h3>
            </div>

            <div class="admin-order-status-stack">
                <div>
                    <span>Status Order</span>
                    <strong class="admin-order-badge admin-order-badge--{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </strong>
                </div>

                <div>
                    <span>Status Pembayaran</span>
                    <strong class="admin-payment-badge admin-payment-badge--{{ $order->payment_status }}">
                        {{ ucfirst($order->payment_status) }}
                    </strong>
                </div>
            </div>
        </article>

        <article class="admin-order-detail-card">
            <div class="admin-order-detail-card__head">
                <span>Payment Summary</span>
                <h3>Rincian Pembayaran</h3>
            </div>

            <div class="admin-order-detail-list">
                <div>
                    <span>Metode Pembayaran</span>
                    <strong>{{ $order->payment->method ?? '-' }}</strong>
                </div>

                <div>
                    <span>Subtotal</span>
                    <strong>Rp{{ number_format($order->subtotal ?? 0, 0, ',', '.') }}</strong>
                </div>

                <div>
                    <span>Kode Unik</span>
                    <strong>Rp{{ number_format($order->unique_code ?? 0, 0, ',', '.') }}</strong>
                </div>

                <div>
                    <span>Total Bayar</span>
                    <strong>Rp{{ number_format($order->grand_total ?? 0, 0, ',', '.') }}</strong>
                </div>
            </div>
        </article>

    </section>

    <section class="admin-order-items-card">
        <div class="admin-order-table-head">
            <div>
                <span>Item Pesanan</span>
                <h2>Produk yang Dibeli</h2>
            </div>
        </div>

        <div class="admin-order-table-wrap">
            <table class="admin-order-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product_name_snapshot }}</strong>
                            </td>

                            <td>
                                {{ $item->size_snapshot ?? '-' }}
                            </td>

                            <td>
                                {{ $item->qty }}
                            </td>

                            <td>
                                Rp{{ number_format($item->price, 0, ',', '.') }}
                            </td>

                            <td>
                                <strong>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="admin-order-empty">
                                    <i class="bi bi-box-seam"></i>
                                    <strong>Tidak ada item pesanan.</strong>
                                    <span>Data item belum tersedia.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection