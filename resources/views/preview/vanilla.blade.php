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

                        <div class="preview-select-wrap">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>
                                <option value="10" data-price="35000">10 ml</option>
                                <option value="30" data-price="59000">30 ml</option>
                                <option value="50" data-price="85000">50 ml</option>
                                <option value="70" data-price="109000">70 ml</option>
                            </select>
                        </div>
                    </div>

                     <div class="preview-branch-block">
    <label class="preview-branch-label">Pilih Cabang Mesin</label>

    <input type="hidden" name="branch_location" id="branchLocationInput" value="UMN">

    <div class="preview-branch-options">
        <button type="button" class="preview-branch-btn is-active" data-branch="UMN">
            <span class="branch-flag">🏫</span>
            <span>UMN</span>
        </button>

        <button type="button" class="preview-branch-btn" data-branch="Summarecon Mall Serpong">
            <span class="branch-flag">🛍️</span>
            <span>SMS</span>
        </button>

        <button type="button" class="preview-branch-btn" data-branch="AEON Mall BSD">
            <span class="branch-flag">🇯🇵</span>
            <span>AEON BSD</span>
        </button>
    </div>

    <div class="preview-branch-detail" id="branchDetailText">
        Mesin dipilih: <strong>UMN</strong> — Jl. Scientia Boulevard, Gading Serpong.
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

                        <button
    type="submit"
    class="preview-btn preview-btn--primary"
    name="buy_now"
    value="1"
>
    Beli Sekarang
</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<script src="{{ asset('js/preview-product.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sizeSelect = document.getElementById('sizeSelect');
    const priceText = document.getElementById('priceText');
    const cartPriceInput = document.getElementById('cartPriceInput');
    const addToCartForm = document.getElementById('addToCartForm');

    const branchButtons = document.querySelectorAll('.preview-branch-btn');
    const branchLocationInput = document.getElementById('branchLocationInput');
    const branchDetailText = document.getElementById('branchDetailText');

    const branchDetails = {
        'UMN': 'Mesin dipilih: <strong>UMN</strong> — Jl. Scientia Boulevard, Gading Serpong.',
        'Summarecon Mall Serpong': 'Mesin dipilih: <strong>SMS</strong> — Summarecon Mall Serpong, Gading Serpong.',
        'AEON Mall BSD': 'Mesin dipilih: <strong>AEON BSD</strong> — AEON Mall BSD City, Tangerang Selatan.'
    };

    function formatRupiah(value) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(value));
    }

    function updatePrice() {
        if (!sizeSelect || !priceText || !cartPriceInput) return;

        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
        const price = selectedOption ? selectedOption.getAttribute('data-price') : '';

        if (sizeSelect.value && price) {
            priceText.textContent = formatRupiah(price);
            cartPriceInput.value = price;
        } else {
            priceText.textContent = 'Pilih ukuran dulu';
            cartPriceInput.value = '';
        }
    }

    if (sizeSelect) {
        sizeSelect.addEventListener('change', updatePrice);
        updatePrice();
    }

    branchButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            branchButtons.forEach(function (item) {
                item.classList.remove('is-active');
            });

            this.classList.add('is-active');

            const branch = this.dataset.branch;
            branchLocationInput.value = branch;
            branchDetailText.innerHTML = branchDetails[branch] || branch;
        });
    });

    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function (e) {
            updatePrice();

            if (!sizeSelect.value || !cartPriceInput.value) {
                e.preventDefault();
                alert('Pilih ukuran dulu sebelum melanjutkan.');
                return;
            }

            if (!branchLocationInput.value) {
                e.preventDefault();
                alert('Pilih cabang mesin dulu sebelum melanjutkan.');
            }
        });
    }
});
</script>
@endsection