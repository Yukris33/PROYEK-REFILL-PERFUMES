@extends('layouts.app')

@section('title', 'Prestige Preview - SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

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

                <p class="preview-desc">
                    SCENTC Prestige Signature menghadirkan karakter aroma premium yang hangat, mewah, dan berkelas. Kesan awalnya terasa lembut dan refined, lalu berkembang menjadi wangi yang lebih dalam, smooth, dan elegan saat dipakai lebih lama.
                </p>

                <p class="preview-desc preview-desc--secondary">
                    Parfum ini cocok buat yang suka aroma dewasa dengan nuansa warm yang nyaman, rapi, dan eksklusif. Karakternya tidak terlalu tajam dan tidak berlebihan manis, tapi lebih ke arah mahal, classy, dan timeless untuk acara formal maupun pemakaian harian.
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

                <div class="preview-size-block">
                    <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>
                    <div class="preview-select-wrap">
                        <select id="sizeSelect" class="preview-select">
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
                    <a href="{{ route('nav.brand') }}" class="preview-btn preview-btn--ghost">Kembali</a>

                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm" style="display:inline;">
                        @csrf
                        <input type="hidden" name="product_key" value="prestige_signature">
                        <input type="hidden" name="name" value="SCENTC Prestige Signature Eau De Parfum">
                        <input type="hidden" name="image" value="{{ asset('img/peach bloom 4 (1) (1).png') }}">
                        <input type="hidden" name="size" id="cartSizeInput">
                        <input type="hidden" name="price" id="cartPriceInput">
                        <input type="hidden" name="type" value="ml">

                        <button type="submit" class="preview-btn preview-btn--cart" id="addToCartBtn">
                            Masukkan Keranjang
                        </button>
                    </form>

                    <button type="button" class="preview-btn preview-btn--primary" id="buyNowBtn">
                        Beli Sekarang
                    </button>
                </div>
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
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BCA">
                            Virtual Account BCA
                        </button>

                        <button type="button" class="payment-method-btn" data-method="Virtual Account BNI">
                            Virtual Account BNI
                        </button>

                        <button type="button" class="payment-method-btn" data-method="Virtual Account Mandiri">
                            Virtual Account Mandiri
                        </button>

                        <button type="button" class="payment-method-btn" data-method="GoPay">
                            GoPay
                        </button>

                        <button type="button" class="payment-method-btn" data-method="ShopeePay">
                            ShopeePay
                        </button>

                        <button type="button" class="payment-method-btn" data-method="DANA">
                            DANA
                        </button>
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

<style>
.payment-modal {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    z-index: 99999;
}

.payment-modal__box {
    width: min(1100px, 96vw);
    background: #fff;
    border-radius: 28px;
    padding: 28px;
    position: relative;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.18);
}

.payment-modal__close {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 50%;
    background: #f3f3f3;
    cursor: pointer;
    font-size: 24px;
    line-height: 1;
}

.payment-modal__header {
    margin-bottom: 22px;
}

.payment-modal__header h2 {
    margin: 0 0 6px;
    font-size: 32px;
}

.payment-modal__header p {
    margin: 0;
    color: #666;
}

.payment-modal__content {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 22px;
}

.payment-card {
    background: #f8f8f8;
    border-radius: 24px;
    padding: 22px;
    height: 100%;
}

.payment-card__title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 6px;
}

.payment-card__subtitle {
    color: #777;
    margin-bottom: 18px;
}

.payment-qris-box {
    background: #fff;
    border: 1px solid #e6e6e6;
    border-radius: 20px;
    min-height: 360px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.payment-qris-placeholder {
    font-size: 28px;
    font-weight: 700;
    color: #222;
}

.payment-card__note {
    margin-top: 16px;
    font-size: 18px;
}

.payment-method-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.payment-method-btn {
    border: 1px solid #d9d9d9;
    background: #fff;
    border-radius: 16px;
    padding: 14px 16px;
    cursor: pointer;
    text-align: left;
    font-size: 16px;
    transition: 0.2s ease;
}

.payment-method-btn:hover,
.payment-method-btn.is-active {
    background: #111;
    color: #fff;
    border-color: #111;
}

.payment-method-detail {
    margin-top: 18px;
    min-height: 72px;
    background: #fff;
    border: 1px solid #e4e4e4;
    border-radius: 16px;
    padding: 16px;
    line-height: 1.6;
}

.payment-card__footer {
    margin-top: 18px;
}

.payment-confirm-btn {
    width: 100%;
    border: none;
    border-radius: 18px;
    padding: 16px 20px;
    background: #111;
    color: #fff;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
}

.preview-info,
.preview-actions,
.preview-btn,
.preview-actions form,
.preview-price-box,
.preview-size-block {
    position: relative;
    z-index: 20;
}

.preview-media,
.preview-media-box {
    position: relative;
    z-index: 1;
}

@media (max-width: 900px) {
    .payment-modal__content {
        grid-template-columns: 1fr;
    }

    .payment-method-list {
        grid-template-columns: 1fr;
    }

    .payment-qris-box {
        min-height: 260px;
    }
}
</style>
@endsection