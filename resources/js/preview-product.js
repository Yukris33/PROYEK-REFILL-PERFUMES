document.addEventListener('DOMContentLoaded', function () {
    const sizeSelect = document.getElementById('sizeSelect');
    const priceText = document.getElementById('priceText');
    const cartPriceInput = document.getElementById('cartPriceInput');
    const addToCartForm = document.getElementById('addToCartForm');
    const buyNowBtn = document.getElementById('buyNowBtn');
    const paymentModal = document.getElementById('paymentModal');
    const closePaymentModal = document.getElementById('closePaymentModal');
    const paymentTotalText = document.getElementById('paymentTotalText');
    const paymentMethodBtns = document.querySelectorAll('.payment-method-btn');
    const paymentMethodDetail = document.getElementById('paymentMethodDetail');
    const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');

    function formatRupiah(value) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(value));
    }

    if (sizeSelect) {
        sizeSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const size = selectedOption.value;
            const price = selectedOption.getAttribute('data-price');

            if (size && price) {
                if (priceText) priceText.textContent = formatRupiah(price);
                if (cartPriceInput) cartPriceInput.value = price;
                if (paymentTotalText) paymentTotalText.textContent = formatRupiah(price);
            } else {
                if (priceText) priceText.textContent = 'Pilih ukuran dulu';
                if (cartPriceInput) cartPriceInput.value = '';
                if (paymentTotalText) paymentTotalText.textContent = 'Rp0';
            }
        });
    }

    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function (e) {
            if (!sizeSelect || !sizeSelect.value || !cartPriceInput || !cartPriceInput.value) {
                e.preventDefault();
                alert('Pilih ukuran dulu sebelum masukin ke keranjang.');
            }
        });
    }

    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', function () {
            if (!sizeSelect || !sizeSelect.value || !cartPriceInput || !cartPriceInput.value) {
                alert('Pilih ukuran dulu sebelum beli.');
                return;
            }

            if (paymentModal) {
                paymentModal.style.display = 'flex';
            }
        });
    }

    if (closePaymentModal) {
        closePaymentModal.addEventListener('click', function () {
            if (paymentModal) {
                paymentModal.style.display = 'none';
            }
        });
    }

    window.addEventListener('click', function (e) {
        if (paymentModal && e.target === paymentModal) {
            paymentModal.style.display = 'none';
        }
    });

    paymentMethodBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            paymentMethodBtns.forEach(function (item) {
                item.classList.remove('is-active');
            });

            this.classList.add('is-active');

            const method = this.getAttribute('data-method');
            if (paymentMethodDetail) {
                paymentMethodDetail.textContent = 'Kamu memilih metode pembayaran: ' + method + '.';
            }
        });
    });

    if (confirmPaymentBtn) {
        confirmPaymentBtn.addEventListener('click', function () {
            if (!sizeSelect || !sizeSelect.value) {
                alert('Pilih ukuran dulu sebelum konfirmasi pembayaran.');
                return;
            }

            alert('Pembayaran berhasil dikonfirmasi.');
            if (paymentModal) {
                paymentModal.style.display = 'none';
            }
        });
    }
});