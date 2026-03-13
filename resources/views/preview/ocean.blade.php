@extends('layouts.app')

@section('title', 'Ocean Breeze Preview - SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>
<link rel="stylesheet" href="{{ asset('css/preview-product.css') }}">

<section class="preview-page" data-page="prestige-preview">
    <div class="preview-wrap">
        <div class="preview-grid">

            <div class="preview-media">
                <div class="preview-media-box">
                    <img src="{{ asset('img/ocean breeze fix.png') }}" alt="SCENTC Ocean Breeze Aqua Eau De Parfum">
                </div>
            </div>

            <div class="preview-info">
                <div class="preview-kicker">AQUATIC FRESH</div>
                <h1 class="preview-title">SCENTC Ocean Breeze Aqua Eau De Parfum</h1>

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
                    SCENTC Ocean Breeze Aqua menghadirkan sensasi aroma fresh aquatic yang ringan, bersih, dan menenangkan.
                    Kesan awalnya terasa segar seperti angin laut yang sejuk, lalu berkembang menjadi wangi yang clean,
                    soft, dan nyaman dipakai sepanjang hari.
                </p>

                <p class="preview-desc preview-desc--secondary">
                    Parfum ini cocok buat yang suka aroma fresh dengan nuansa watery yang modern, simpel, dan bikin rileks.
                    Karakternya tidak terlalu berat dan tidak menusuk, tapi lebih ke arah bersih, energizing,
                    dan effortless untuk pemakaian harian maupun aktivitas outdoor.
                </p>

                <div class="preview-notes">
                    <div class="preview-note-item">
                        <span class="label">Character</span>
                        <strong>Fresh Aquatic · Clean · Invigorating</strong>
                    </div>
                    <div class="preview-note-item">
                        <span class="label">Category</span>
                        <strong>Eau De Parfum</strong>
                    </div>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                    @csrf

                    <input type="hidden" name="product_slug" value="ocean-breeze-aqua">
                    <input type="hidden" name="product_name" value="SCENTC Ocean Breeze Aqua Eau De Parfum">
                    <input type="hidden" name="product_image" value="img/ocean breeze fix.png">
                    <input type="hidden" name="product_brand" value="SCENTC">
                    <input type="hidden" name="product_category" value="refill">
                    <input type="hidden" name="product_description" value="Fresh aquatic parfum">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" id="cartPriceInput">

                    <div class="preview-size-block">
                        <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>

                        <div class="preview-select-wrm">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>
                                <option value="20" data-price="35000">20 ml</option>
                                <option value="30" data-price="55000">30 ml</option>
                                <option value="50" data-price="79000">50 ml</option>
                                <option value="100" data-price="139000">100 ml</option>
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

<div class="payment-modal" id="paymentModal" style="display:none;">
    <div class="payment-modal__box">
        <button type="button" class="payment-modal__close" id="closePaymentModal">&times;</button>

        <div class="payment-modal__header">
            <h2>Pilih Metode Pembayaran</h2>
            <p>Selesaikan pembelian tanpa pindah halaman.</p>
        </div>

        <div class="payment-modal__content">
            <div class="payment-modal__left">
                <div class="payment-card">
                    <div class="payment-card__title">QRIS</div>
                    <div class="payment-card__subtitle">Scan QR untuk bayar</div>

                    <div class="payment-qris-box">
                        <div class="payment-qris-placeholder">QRIS Preview</div>
                    </div>

                    <div class="payment-card__note">
                        Total:
                        <strong id="paymentTotalText">Rp0</strong>
                    </div>
                </div>
            </div>

            <div class="payment-modal__right">
                <div class="payment-card">
                    <div class="payment-card__title">Metode Lain</div>
                    <div class="payment-card__subtitle">Pilih pembayaran yang kamu mau</div>

                    <div class="payment-method-list">
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BCA">Virtual Account BCA</button>
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BNI">Virtual Account BNI</button>
                        <button type="button" class="payment-method-btn" data-method="Virtual Account Mandiri">Virtual Account Mandiri</button>
                        <button type="button" class="payment-method-btn" data-method="GoPay">GoPay</button>
                        <button type="button" class="payment-method-btn" data-method="ShopeePay">ShopeePay</button>
                        <button type="button" class="payment-method-btn" data-method="DANA">DANA</button>
                    </div>

                    <div class="payment-method-detail" id="paymentMethodDetail">
                        Pilih metode pembayaran dulu.
                    </div>

                    <div class="payment-card__footer">
                        <button type="button" class="payment-confirm-btn" id="confirmPaymentBtn">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/preview-product.js') }}"></script>
@endsection