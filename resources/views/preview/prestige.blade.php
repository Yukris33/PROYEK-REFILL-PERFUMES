@extends('layouts.app')

@section('title', 'Prestige Preview - SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

<section class="preview-page">
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


                <input type="hidden" name="type" value="ml">
                <input type="hidden" name="price" id="cartPriceInput">

                <div class="preview-price-box">
                    <span class="preview-price-label">Harga</span>
                    <div class="preview-price-value" id="priceText">Pilih ukuran dulu</div>
                </div>

                <div class="preview-actions">
                    <a href="{{ route('nav.brand') }}" class="preview-btn preview-btn--ghost">Kembali</a>
                    <button type="button" class="preview-btn preview-btn--cart">Masukkan Keranjang</button>
                    <button type="button" class="preview-btn preview-btn--primary">Beli Sekarang</button>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
(function () {
    const sizeSelect = document.getElementById('sizeSelect');
    const priceText = document.getElementById('priceText');

    function formatRupiah(number) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(number));
    }

    function updatePrice() {
        if (!sizeSelect || !priceText) return;

        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
        const price = selectedOption ? selectedOption.dataset.price : '';

        if (price) {
            priceText.textContent = formatRupiah(price);
        } else {
            priceText.textContent = 'Pilih ukuran dulu';
        }
    }

    if (sizeSelect) {
        sizeSelect.addEventListener('change', updatePrice);
        updatePrice();
    }
})();
</script>
@endsection