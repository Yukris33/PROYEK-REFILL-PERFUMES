@extends('layouts.app')

@section('title','Keranjang')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

<style>
.cart-page {
    padding: 48px 20px 72px;
}
.cart-container {
    max-width: 1120px;
    margin: 0 auto;
}
.cart-header {
    margin-bottom: 28px;
}
.cart-header h1 {
    font-size: 48px;
    line-height: 1.1;
    margin: 0 0 10px;
}
.cart-header p {
    margin: 0;
    color: #666;
    font-size: 18px;
}
.cart-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 28px;
    align-items: start;
}
.cart-items {
    display: grid;
    gap: 16px;
}
.cart-item {
    display: grid;
    grid-template-columns: 28px 96px minmax(0, 1fr) 150px;
    gap: 16px;
    align-items: center;
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 22px;
    padding: 18px;
}
.cart-img img {
    width: 96px;
    height: 96px;
    object-fit: cover;
    border-radius: 16px;
    display: block;
}
.cart-info h3 {
    margin: 0 0 8px;
    font-size: 20px;
}
.cart-info p {
    margin: 0 0 6px;
    color: #666;
}
.cart-actions {
    display: flex;
    gap: 10px;
    margin-top: 12px;
    flex-wrap: wrap;
}
.cart-edit-btn,
.delete,
.checkout-btn {
    border: none;
    border-radius: 12px;
    padding: 10px 16px;
    cursor: pointer;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.cart-edit-btn {
    background: #111;
    color: #fff;
}
.delete {
    background: #f3f3f3;
    color: #111;
}
.cart-subtotal {
    text-align: right;
    font-weight: 700;
    font-size: 18px;
}
.cart-summary {
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 22px;
    padding: 22px;
    position: sticky;
    top: 24px;
}
.cart-summary h3 {
    margin: 0 0 18px;
    font-size: 24px;
}
.summary-row {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 14px;
    font-size: 17px;
}
.summary-row strong {
    font-size: 22px;
}
.checkout-btn {
    width: 100%;
    margin-top: 18px;
    background: #111;
    color: #fff;
    min-height: 50px;
}
.cart-empty {
    background: #fff;
    border: 1px solid #ececec;
    border-radius: 22px;
    padding: 24px;
}
.qty-form {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-top: 12px;
    flex-wrap: wrap;
}
.qty-form input {
    width: 74px;
    padding: 9px 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
}
@media (max-width: 900px) {
    .cart-grid {
        grid-template-columns: 1fr;
    }
    .cart-item {
        grid-template-columns: 1fr;
        text-align: left;
    }
    .cart-subtotal {
        text-align: left;
    }
    .cart-header h1 {
        font-size: 34px;
    }
}
</style>

<section class="cart-page">
  <div class="cart-container">
    <div class="cart-header">
      <h1>Keranjang Belanja</h1>
      <p>Cek kembali item pilihan Anda sebelum lanjut ke checkout.</p>
    </div>

    @if (session('success'))
      <div style="background:#eafaf1; color:#166534; padding:14px 16px; border-radius:12px; margin-bottom:16px;">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div style="background:#fef2f2; color:#991b1b; padding:14px 16px; border-radius:12px; margin-bottom:16px;">
        {{ session('error') }}
      </div>
    @endif

    <div class="cart-grid">
      <div class="cart-items">
        @forelse($cart->items as $item)
          <div class="cart-item">
            <div class="cart-check">
              <input type="checkbox" checked>
            </div>

            <div class="cart-img">
              <img src="{{ asset($item->product->image ?? 'img/default.png') }}" alt="{{ $item->product->name ?? 'Product' }}">
            </div>

            <div class="cart-info">
              <h3>{{ $item->product->name ?? '-' }}</h3>
              <p>Ukuran : {{ $item->variant->size_ml ?? '-' }} ml</p>
              <p>Harga : Rp{{ number_format($item->price_snapshot, 0, ',', '.') }}</p>

              <div class="cart-actions">
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="qty-form">
                  @csrf
                  <input type="number" name="qty" value="{{ $item->qty }}" min="1">
                  <button type="submit" class="cart-edit-btn">Update</button>
                </form>

                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete" onclick="return confirm('Yakin mau hapus item ini?')">
                    Delete
                  </button>
                </form>
              </div>
            </div>

            <div class="cart-subtotal">
              Rp{{ number_format($item->subtotal, 0, ',', '.') }}
            </div>
          </div>
        @empty
          <div class="cart-empty">
            Keranjang masih kosong
          </div>
        @endforelse
      </div>

      <div class="cart-summary">
        <h3>Ringkasan Belanja</h3>

        <div class="summary-row">
          <span>Total Item</span>
          <span>{{ $totalItem }}</span>
        </div>

        <div class="summary-row">
          <span>Total Belanja</span>
          <strong>Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong>
        </div>

        <a href="#" class="checkout-btn">Checkout</a>
      </div>
    </div>
  </div>
</section>
@endsection