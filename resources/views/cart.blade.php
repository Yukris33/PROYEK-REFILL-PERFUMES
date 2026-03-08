@extends('layouts.app')

@section('title','Keranjang')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

<section class="cart-page">
  <div class="cart-container">
    <div class="cart-header">
      <h1>Keranjang Belanja</h1>
      <p>Cek kembali item pilihan Anda sebelum lanjut ke checkout.</p>
    </div>

    @php
      $total = 0;
      $totalItem = 0;

      foreach($cart as $item){
        $total += $item['price'] * $item['qty'];

        if(($item['type'] ?? 'each') == 'ml'){
          $totalItem += (int) str_replace(' ml', '', $item['size']);
        } else {
          $totalItem += $item['qty'];
        }
      }
    @endphp

    <div class="cart-grid">
      <div class="cart-items">
        @forelse($cart as $key => $item)
          <div class="cart-item">
            <div class="cart-check">
              <input type="checkbox" checked>
            </div>

            <div class="cart-img">
              <img src="{{ $item['image'] }}" alt="">
            </div>

            <div class="cart-info">
              <h3>{{ $item['name'] }}</h3>

              <p>Ukuran : {{ $item['size'] }}</p>
              <p>Harga : Rp{{ number_format($item['price']) }}</p>

              <div class="cart-actions">
                <button>Edit</button>
                <button class="delete">Delete</button>
              </div>
            </div>

            <div class="cart-subtotal">
              Rp{{ number_format($item['price'] * $item['qty']) }}
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
          <strong>Rp{{ number_format($total) }}</strong>
        </div>

        <button class="checkout-btn">Checkout</button>
      </div>
    </div>
  </div>
</section>
@endsection