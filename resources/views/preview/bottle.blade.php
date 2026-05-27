@extends('layouts.app')

@section('title', $bottle['name'] . ' - SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/main.css?v=107') }}"></div>

<section class="preview-page" data-page="bottle-preview">
    <div class="preview-wrap">
        <div class="preview-grid">

            <div class="preview-media">
                <div class="preview-media-box">
                    <img src="{{ asset($bottle['image']) }}" alt="{{ $bottle['name'] }}">
                </div>
            </div>

            <div class="preview-info">
                <div class="preview-kicker">{{ $bottle['kicker'] }}</div>
                <h1 class="preview-title">{{ $bottle['name'] }}</h1>

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
                    {{ $bottle['description'] }}
                </p>

                <p class="preview-desc preview-desc--secondary">
                    {{ $bottle['description2'] }}
                </p>

                <div class="preview-notes">
                    <div class="preview-note-item">
                        <span class="label">Character</span>
                        <strong>{{ $bottle['character'] }}</strong>
                    </div>

                    <div class="preview-note-item">
                        <span class="label">Category</span>
                        <strong>{{ $bottle['type'] }}</strong>
                    </div>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                    @csrf

                    <input type="hidden" name="product_slug" value="{{ $bottle['slug'] }}">
                    <input type="hidden" name="product_name" value="{{ $bottle['name'] }}">
                    <input type="hidden" name="product_image" value="{{ $bottle['image'] }}">
                    <input type="hidden" name="product_brand" value="SCENTC">
                    <input type="hidden" name="product_category" value="bottle">
                    <input type="hidden" name="product_description" value="{{ $bottle['description'] }}">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" id="cartPriceInput">

                    <div class="preview-size-block">
                        <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>

                        <div class="preview-select-wrap">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>

                                @foreach($bottle['sizes'] as $size => $price)
                                    <option value="{{ $size }}" data-price="{{ $price }}">
                                        {{ $size }} ml
                                    </option>
                                @endforeach
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
                        <a href="{{ route('products.botol') }}" class="preview-btn preview-btn--ghost">
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