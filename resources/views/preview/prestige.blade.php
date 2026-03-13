@extends('layouts.app')

@section('title', 'Prestige Preview - SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>
<link rel="stylesheet" href="{{ asset('css/preview-product.css') }}">

<section class="preview-page" data-page="prestige-preview">
    <div class="preview-wrap">
        <div class="preview-grid">

            <div class="preview-media">
                <div class="preview-media-box">
                    <img src="{{ asset('img/peach bloom 4 (1) (1).png') }}" alt="SCENTC Prestige Signature Eau De Parfum">
                </div>
            </div>

            <div class="preview-info">
                <div class="preview-kicker">PRESTIGE</div>
                <h1 class="preview-title">SCENTC Prestige Signature Eau De Parfum</h1>

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
                    SCENTC Prestige Signature menghadirkan karakter aroma premium yang hangat, mewah, dan berkelas.
                    Kesan awalnya terasa lembut dan refined, lalu berkembang menjadi wangi yang lebih dalam,
                    smooth, dan elegan saat dipakai lebih lama.
                </p>

                <p class="preview-desc preview-desc--secondary">
                    Parfum ini cocok buat yang suka aroma dewasa dengan nuansa warm yang nyaman, rapi, dan eksklusif.
                    Karakternya tidak terlalu tajam dan tidak berlebihan manis, tapi lebih ke arah mahal,
                    classy, dan timeless untuk acara formal maupun pemakaian harian.
                </p>

                <div class="preview-notes">
                    <div class="preview-note-item">
                        <span class="label">Character</span>
                        <strong>Premium Warm · Elegant · Timeless</strong>
                    </div>
                    <div class="preview-note-item">
                        <span class="label">Category</span>
                        <strong>Eau De Parfum</strong>
                    </div>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                    @csrf

                    <input type="hidden" name="product_slug" value="prestige-signature">
                    <input type="hidden" name="product_name" value="SCENTC Prestige Signature Eau De Parfum">
                    <input type="hidden" name="product_image" value="img/peach bloom 4 (1) (1).png">
                    <input type="hidden" name="product_brand" value="SCENTC">
                    <input type="hidden" name="product_category" value="refill">
                    <input type="hidden" name="product_description" value="Premium warm elegant parfum">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" id="cartPriceInput">

                    <div class="preview-size-block">
                        <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>

                        <div class="preview-select-wrm">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>
                                <option value="15" data-price="39000">15 ml</option>
                                <option value="30" data-price="69000">30 ml</option>
                                <option value="50" data-price="99000">50 ml</option>
                                <option value="100" data-price="169000">100 ml</option>
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