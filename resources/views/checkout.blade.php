@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>

<style>
    .checkout-page {
        width: 100%;
        padding: 40px 0 70px;
        background: #f6f6f6;
    }

    .checkout-container {
        width: min(1200px, calc(100% - 48px));
        margin: 0 auto;
    }

    .checkout-header {
        margin-bottom: 26px;
    }

    .checkout-header h1 {
        font-size: 52px;
        margin-bottom: 8px;
        font-weight: 500;
        letter-spacing: -0.02em;
    }

    .checkout-header p {
        color: #666;
        margin: 0;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.35fr 1fr;
        gap: 26px;
        align-items: start;
    }

    .checkout-card {
        background: #fff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 28px rgba(0,0,0,0.05);
    }

    .checkout-product {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 24px;
        align-items: start;
    }

    .checkout-product__img {
        background: #f8f8f8;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #ededed;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 220px;
    }

    .checkout-product__img img {
        max-width: 100%;
        max-height: 220px;
        object-fit: contain;
        display: block;
    }

    .checkout-kicker {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .16em;
        color: #888;
        margin-bottom: 10px;
    }

    .checkout-product h2 {
        margin: 0 0 18px;
        font-size: 28px;
        line-height: 1.25;
    }

    .checkout-info-list {
        display: grid;
        gap: 12px;
    }

    .checkout-info-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #efefef;
    }

    .checkout-info-row span:first-child {
        color: #666;
    }

    .checkout-info-row strong {
        color: #111;
        text-align: right;
    }

    .checkout-summary-title {
        font-size: 24px;
        margin: 0 0 18px;
    }

    .payment-method-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .payment-method-btn {
        border: 1px solid #ddd;
        background: #fff;
        border-radius: 14px;
        padding: 14px 14px;
        cursor: pointer;
        text-align: left;
        font-size: 14px;
        transition: .2s ease;
    }

    .payment-method-btn.active,
    .payment-method-btn:hover {
        background: #111;
        color: #fff;
        border-color: #111;
    }

    .payment-detail-box {
        background: #f8f8f8;
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 16px;
        min-height: 72px;
        margin-bottom: 16px;
        line-height: 1.6;
        color: #333;
    }

    .checkout-status-box {
        background: #fafafa;
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 18px;
    }

    .checkout-status-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }

    .checkout-status-row:last-child {
        margin-bottom: 0;
    }

    .checkout-status-row span {
        color: #666;
    }

    .checkout-status-row strong {
        text-align: right;
    }

    .checkout-confirm-btn {
        width: 100%;
        border: none;
        border-radius: 18px;
        padding: 16px 20px;
        background: #111;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
    }

    .checkout-confirm-btn:hover {
        background: #222;
    }

    .qris-box {
        display: grid;
        gap: 16px;
        justify-items: center;
        text-align: center;
        padding: 14px;
    }

    .fake-qris {
        width: 240px;
        height: 240px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 18px;
        padding: 18px;
        display: grid;
        place-items: center;
    }

    .qr-grid {
        width: 190px;
        height: 190px;
        display: grid;
        grid-template-columns: repeat(9, 1fr);
        grid-template-rows: repeat(9, 1fr);
        gap: 4px;
    }

    .qr-grid span {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .qr-grid span.dark {
        background: #111;
    }

    .qris-info {
        display: grid;
        gap: 5px;
    }

    .qris-info strong {
        font-size: 16px;
    }

    .qris-info span {
        color: #111;
        font-weight: 700;
    }

    .qris-info small {
        color: #666;
    }

    .number-payment-box {
        line-height: 1.7;
    }

    .payment-warning-box {
        margin-top: 14px;
        margin-bottom: 14px;
        padding: 14px 16px;
        border-radius: 14px;
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #b91c1c;
        font-size: 14px;
        line-height: 1.6;
        font-weight: 500;
    }

    .payment-warning-box strong {
        color: #991b1b;
    }

    /* VOUCHER CHECKOUT */
    .scent-voucher-box {
        margin-bottom: 16px;
        padding: 16px;
        border-radius: 18px;
        background:
            radial-gradient(circle at top right, rgba(31,157,89,.10), transparent 38%),
            #ffffff;
        border: 1px solid #ececec;
        box-shadow: 0 12px 28px rgba(0,0,0,.04);
    }

    .scent-voucher-box__head {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 14px;
    }

    .scent-voucher-box__head span {
        display: block;
        color: #888;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .scent-voucher-box__head h3 {
        margin: 0;
        color: #111;
        font-size: 20px;
        letter-spacing: -.02em;
    }

    .scent-voucher-select-wrap {
        display: grid;
        gap: 8px;
        color: #111;
        font-size: 12px;
        font-weight: 700;
    }

    .scent-voucher-select-wrap select {
        width: 100%;
        min-height: 44px;
        border-radius: 14px;
        border: 1px solid #ddd;
        background: #fff;
        padding: 0 14px;
        outline: none;
        color: #111;
        font-size: 13px;
        font-weight: 600;
    }

    .scent-voucher-info {
        margin-top: 12px;
        padding: 12px 14px;
        border-radius: 14px;
        background: #f8f8f8;
        color: #666;
        font-size: 13px;
        line-height: 1.6;
    }

    .scent-voucher-info.is-active {
        background: #ecfdf3;
        color: #166534;
    }

    .scent-voucher-empty {
        padding: 14px;
        border-radius: 16px;
        background: #f8f8f8;
        border: 1px solid #ececec;
    }

    .scent-voucher-empty strong {
        display: block;
        color: #111;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .scent-voucher-empty p {
        margin: 0 0 12px;
        color: #666;
        font-size: 13px;
        line-height: 1.6;
    }

    .scent-voucher-empty a {
        min-height: 36px;
        padding: 0 14px;
        border-radius: 999px;
        background: #111;
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
    }

    @media (max-width: 900px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .checkout-product {
            grid-template-columns: 1fr;
        }

        .checkout-product__img {
            min-height: 180px;
        }

        .checkout-header h1 {
            font-size: 40px;
        }
    }
</style>

<section class="checkout-page">
    <div class="checkout-container">

        <div class="checkout-header">
            <h1>Checkout</h1>
            <p>Pilih metode pembayaran untuk melanjutkan pesanan Anda.</p>
        </div>

        <div class="checkout-grid">

            {{-- KIRI: DETAIL PRODUK --}}
            <div class="checkout-card">
                <div class="checkout-product">
                    <div class="checkout-product__img">
                        <img src="{{ asset($firstItem->product->image ?? 'img/default.png') }}" alt="{{ $firstItem->product->name }}">
                    </div>

                    <div class="checkout-product__detail">
                        <div class="checkout-kicker">Ringkasan Pesanan</div>

                        <h2>{{ $firstItem->product->name }}</h2>

                        <div class="checkout-info-list">
                            <div class="checkout-info-row">
                                <span>Jenis</span>
                                <strong>{{ $firstItem->product->type ?? $firstItem->product->category ?? '-' }}</strong>
                            </div>

                            <div class="checkout-info-row">
                                <span>Nama Parfum</span>
                                <strong>{{ $firstItem->product->name }}</strong>
                            </div>

                            <div class="checkout-info-row">
                                <span>Ukuran</span>
                                <strong>{{ $firstItem->variant->size_ml ?? '-' }} ml</strong>
                            </div>

                            <div class="checkout-info-row">
                                <span>Tanggal Order</span>
                                <strong>{{ $orderDate->format('d M Y, H:i') }}</strong>
                            </div>

                            <div class="checkout-info-row">
                                <span>Bonus Poin</span>
                                <strong>{{ auth()->check() ? $bonusPoints . ' poin' : '-' }}</strong>
                            </div>

                            <div class="checkout-info-row">
                                <span>Total Item</span>
                                <strong>{{ $totalItem }}</strong>
                            </div>

                            <div class="checkout-info-row">
                                <span>Total Belanja</span>
                                <strong>Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: PEMBAYARAN + STATUS --}}
            <div class="checkout-card">
                <h3 class="checkout-summary-title">Metode Pembayaran</h3>

                @if (session('error'))
                    <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:12px;margin-bottom:14px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="payment_method" id="paymentMethodInput" value="QRIS">

                    {{-- VOUCHER AKUN --}}
                    <div class="scent-voucher-box">
                        <div class="scent-voucher-box__head">
                            <div>
                                <span>Voucher Akun</span>
                                <h3>Pakai voucher kamu</h3>
                            </div>
                        </div>

                        @auth
                            @if(isset($checkoutVouchers) && $checkoutVouchers->count() > 0)
                                <label class="scent-voucher-select-wrap">
                                    Pilih Voucher
                                    <select name="user_voucher_id" id="userVoucherSelect">
                                        <option value="">Tidak pakai voucher</option>

                                        @foreach($checkoutVouchers as $userVoucher)
                                            <option
                                                value="{{ $userVoucher->id }}"
                                                data-type="{{ $userVoucher->voucher->reward_type ?? '' }}"
                                                data-value="{{ $userVoucher->voucher->reward_value ?? 0 }}"
                                                data-name="{{ $userVoucher->voucher->name ?? 'Voucher' }}"
                                            >
                                                {{ $userVoucher->voucher->name ?? 'Voucher' }} — {{ $userVoucher->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>

                                <div class="scent-voucher-info" id="voucherInfo">
                                    Pilih voucher untuk melihat benefit yang digunakan.
                                </div>
                            @else
                                <div class="scent-voucher-empty">
                                    <strong>Belum ada voucher aktif</strong>
                                    <p>Klaim voucher dulu di halaman Voucher & Bantuan, lalu voucher akan muncul di sini.</p>
                                    <a href="{{ route('nav.voucher-bantuan') }}">Klaim Voucher</a>
                                </div>
                            @endif
                        @else
                            <div class="scent-voucher-empty">
                                <strong>Login untuk memakai voucher</strong>
                                <p>Voucher hanya bisa dipakai oleh akun yang sudah login.</p>
                                <a href="{{ route('login') }}">Login Sekarang</a>
                            </div>
                        @endauth
                    </div>

                    <div class="payment-method-list">
                        <button type="button" class="payment-method-btn active" data-method="QRIS">QRIS</button>
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BCA">VA BCA</button>
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BNI">VA BNI</button>
                        <button type="button" class="payment-method-btn" data-method="ShopeePay">ShopeePay</button>
                        <button type="button" class="payment-method-btn" data-method="DANA">DANA</button>
                        <button type="button" class="payment-method-btn" data-method="GoPay">GoPay</button>
                    </div>

                    <div class="payment-detail-box" id="paymentDetailBox">
                        <div id="qrisBox" class="qris-box">
                            <div class="fake-qris">
                                <div class="qr-grid">
                                    @for ($i = 1; $i <= 81; $i++)
                                        <span class="{{ in_array($i, [1,2,3,4,5,6,7,10,16,19,25,28,29,30,31,32,33,34,35,55,56,57,58,59,60,61,62,64,70,73,79,80,81]) ? 'dark' : '' }}"></span>
                                    @endfor
                                </div>
                            </div>

                            <div class="qris-info">
                                <strong>QRIS SCENTCYCLE</strong>
                                <span>Total: Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                                <small>Scan QRIS ini untuk simulasi pembayaran.</small>
                            </div>
                        </div>

                        <div id="numberPaymentBox" class="number-payment-box" style="display:none;">
                            Scan QRIS untuk melakukan pembayaran.
                        </div>
                    </div>

                    <div class="payment-detail-box" id="uniquePaymentBox" style="margin-top:14px;">
    <div style="display:flex;justify-content:space-between;gap:16px;margin-bottom:8px;">
        <span>Subtotal</span>
        <strong id="subtotalText">Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong>
    </div>

    <div style="display:flex;justify-content:space-between;gap:16px;margin-bottom:8px;">
        <span>Diskon Voucher</span>
        <strong id="voucherDiscountText">-</strong>
    </div>

    <div style="display:flex;justify-content:space-between;gap:16px;margin-bottom:8px;">
        <span>Kode Unik</span>
        <strong id="uniqueCodeText">-</strong>
    </div>

    <div style="display:flex;justify-content:space-between;gap:16px;">
        <span>Total Bayar</span>
        <strong id="paymentAmountText">Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong>
    </div>
</div>

                    <div id="paymentWarningBox" class="payment-warning-box" style="display:none;">
                        <strong>Warning:</strong>
                        Tolong lakukan pembayaran sesuai dengan nominal harga dan kode unik agar payment dapat diproses.
                    </div>

                    <div class="checkout-status-box">
                        <div class="checkout-status-row">
                            <span>Metode</span>
                            <strong id="selectedMethodText">QRIS</strong>
                        </div>

                        <div class="checkout-status-row">
                            <span>Status</span>
                            <strong>Menunggu konfirmasi pembayaran</strong>
                        </div>
                    </div>

                    <button type="submit" class="checkout-confirm-btn">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<script>
    const methodButtons = document.querySelectorAll('.payment-method-btn');
    const selectedMethodText = document.getElementById('selectedMethodText');
    const paymentMethodInput = document.getElementById('paymentMethodInput');

    const qrisBox = document.getElementById('qrisBox');
    const numberPaymentBox = document.getElementById('numberPaymentBox');

    const grandTotal = {{ $grandTotal }};
    const checkoutUniqueCode = {{ $checkoutUniqueCode }};

    const uniqueCodeText = document.getElementById('uniqueCodeText');
    const paymentAmountText = document.getElementById('paymentAmountText');
    const paymentWarningBox = document.getElementById('paymentWarningBox');
    const voucherDiscountText = document.getElementById('voucherDiscountText');

    const voucherSelect = document.getElementById('userVoucherSelect');
    const voucherInfo = document.getElementById('voucherInfo');

    let selectedVoucherDiscount = 0;
    let currentPaymentMethod = 'QRIS';

    const methodDetails = {
        'QRIS': 'Scan QRIS untuk melakukan pembayaran.',
        'Virtual Account BCA': 'Transfer ke Virtual Account BCA: 880812341234',
        'Virtual Account BNI': 'Transfer ke Virtual Account BNI: 988812341234',
        'ShopeePay': 'Nomor ShopeePay: 0813-2222-1111',
        'DANA': 'Nomor DANA: 0813-2222-1111',
        'GoPay': 'Nomor GoPay: 0813-2222-1111'
    };

    function formatRupiah(value) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(value || 0));
    }

    function calculateVoucherDiscount() {
        if (!voucherSelect || !voucherSelect.value) {
            return 0;
        }

        const selected = voucherSelect.options[voucherSelect.selectedIndex];
        const type = selected.dataset.type;
        const value = Number(selected.dataset.value || 0);

        let discount = 0;

        if (type === 'discount_percent') {
            discount = Math.round(grandTotal * (value / 100));
        } else if (type === 'discount_amount') {
            discount = value;
        } else if (type === 'free_refill') {
            // Frontend hanya preview. Backend tetap validasi utama.
            discount = 0;
        }

        return Math.min(discount, grandTotal);
    }

    function refreshPaymentTotal() {
        selectedVoucherDiscount = calculateVoucherDiscount();

        const totalAfterDiscount = Math.max(0, grandTotal - selectedVoucherDiscount);
        const finalPayment = currentPaymentMethod === 'QRIS'
            ? totalAfterDiscount
            : totalAfterDiscount + checkoutUniqueCode;

        if (voucherDiscountText) {
            voucherDiscountText.textContent = selectedVoucherDiscount > 0
                ? '- ' + formatRupiah(selectedVoucherDiscount)
                : '-';
        }

        if (uniqueCodeText) {
            uniqueCodeText.textContent = currentPaymentMethod === 'QRIS'
                ? '-'
                : formatRupiah(checkoutUniqueCode);
        }

        if (paymentAmountText) {
            paymentAmountText.textContent = formatRupiah(finalPayment);
        }

        const qrisTotalText = document.querySelector('.qris-info span');
        if (qrisTotalText) {
            qrisTotalText.textContent = 'Total: ' + formatRupiah(totalAfterDiscount);
        }
    }

    if (voucherSelect && voucherInfo) {
        voucherSelect.addEventListener('change', function () {
            const selected = voucherSelect.options[voucherSelect.selectedIndex];

            if (!selected.value) {
                voucherInfo.textContent = 'Pilih voucher untuk melihat benefit yang digunakan.';
                voucherInfo.classList.remove('is-active');
                refreshPaymentTotal();
                return;
            }

            const type = selected.dataset.type;
            const value = selected.dataset.value;
            const name = selected.dataset.name;

            let message = name + ' dipilih.';

            if (type === 'discount_percent') {
                message = name + ' aktif. Total akan mendapat potongan ' + parseInt(value) + '%.';
            } else if (type === 'discount_amount') {
                message = name + ' aktif. Total akan mendapat potongan ' + formatRupiah(value) + '.';
            } else if (type === 'free_refill') {
                message = name + ' aktif. Reward refill/spray akan diproses sesuai ketentuan voucher.';
            }

            voucherInfo.textContent = message;
            voucherInfo.classList.add('is-active');

            refreshPaymentTotal();
        });
    }

    methodButtons.forEach(button => {
        button.addEventListener('click', function () {
            methodButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const method = this.dataset.method;

            currentPaymentMethod = method;
            selectedMethodText.textContent = method;
            paymentMethodInput.value = method;

            if (method === 'QRIS') {
                qrisBox.style.display = 'grid';
                numberPaymentBox.style.display = 'none';
                paymentWarningBox.style.display = 'none';
            } else {
                qrisBox.style.display = 'none';
                numberPaymentBox.style.display = 'block';
                numberPaymentBox.textContent = methodDetails[method] ?? '-';
                paymentWarningBox.style.display = 'block';
            }

            refreshPaymentTotal();
        });
    });

    refreshPaymentTotal();
</script>
@endsection