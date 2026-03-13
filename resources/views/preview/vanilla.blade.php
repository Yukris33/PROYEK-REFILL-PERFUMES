@extends('layouts.app')

@section('title', 'Vanilla Suede Preview - SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>
<link rel="stylesheet" href="{{ asset('css/preview-product.css') }}">

<section class="preview-page" data-page="prestige-preview">
    <div class="preview-wrap">
        <div class="preview-grid">

            <div class="preview-media">
                <div class="preview-media-box">
                    <img src="{{ asset('img/vanila.png') }}" alt="SCENTC Vanilla Suede Eau De Parfum">
                </div>
            </div>

            <div class="preview-info">
                <div class="preview-kicker">GOURMAND WARM</div>
                <h1 class="preview-title">SCENTC Vanilla Suede Eau De Parfum</h1>

                @if (session('error'))
                    <div style="margin-bottom:16px; color:#991b1b;">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div style="margin-bottom:16px; color:#991b1b;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <p class="preview-desc">
                    SCENTC Vanilla Suede menghadirkan aroma gourmand yang hangat, creamy, dan memikat.
                    Kesan awalnya terasa manis lembut dari vanilla yang halus, lalu berkembang menjadi
                    wangi yang warm, smooth, dan addictive saat dipakai lebih lama.
                </p>

                <p class="preview-desc preview-desc--secondary">
                    Parfum ini cocok buat yang suka aroma manis elegan dengan nuansa cozy dan sensual.
                    Karakternya lembut namun tetap kaya, memberi kesan hangat, nyaman, dan classy
                    untuk dipakai siang maupun malam.
                </p>

                <div class="preview-notes">
                    <div class="preview-note-item">
                        <span class="label">Character</span>
                        <strong>Warm · Creamy · Addictive</strong>
                    </div>

                    <div class="preview-note-item">
                        <span class="label">Category</span>
                        <strong>Eau De Parfum</strong>
                    </div>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                    @csrf

                    <input type="hidden" name="product_slug" value="vanilla-suede">
                    <input type="hidden" name="product_name" value="SCENTC Vanilla Suede Eau De Parfum">
                    <input type="hidden" name="product_image" value="img/vanila.png">
                    <input type="hidden" name="product_brand" value="SCENTC">
                    <input type="hidden" name="product_category" value="refill">
                    <input type="hidden" name="product_description" value="Warm creamy vanilla parfum">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" id="cartPriceInput">

                    <div class="preview-size-block">
                        <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>

                        <div class="preview-select-wrm">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>
                                <option value="10" data-price="35000">10 ml</option>
                                <option value="30" data-price="59000">30 ml</option>
                                <option value="50" data-price="85000">50 ml</option>
                                <option value="70" data-price="109000">70 ml</option>
                            </select>
                        </div>
                    </div>

                    <div class="preview-price-box">
                        <span class="preview-price-label">Harga</span>
                        <div class="preview-price-value" id="priceText">Pilih ukuran dulu</div>
                    </div>

                    <div class="preview-actions">
                        <a href="{{ route('nav.brand') }}" class="preview-btn preview-btn--ghost">
                            Kembali
                        </a>

                        <button type="submit" class="preview-btn preview-btn--cart">
                            Masukkan Keranjang
                        </button>

                        <button type="button" class="preview-btn preview-btn--primary" id="buyNowBtn">
                            Beli Sekarang
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<script src="{{ asset('js/preview-product.js') }}"></script>
@endsection