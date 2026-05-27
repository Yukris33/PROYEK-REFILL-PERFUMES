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
        if (!sizeSelect || !priceText || !cartPriceInput) {
            return;
        }

        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];

        if (!selectedOption) {
            priceText.textContent = 'Pilih ukuran dulu';
            cartPriceInput.value = '';
            return;
        }

        const size = selectedOption.value;
        const price = selectedOption.getAttribute('data-price');

        if (size && price) {
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

    if (branchButtons.length > 0 && branchLocationInput && branchDetailText) {
        branchButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                branchButtons.forEach(function (item) {
                    item.classList.remove('is-active');
                });

                this.classList.add('is-active');

                const branch = this.getAttribute('data-branch');

                branchLocationInput.value = branch;
                branchDetailText.innerHTML = branchDetails[branch] || branch;
            });
        });
    }

    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function (e) {
            updatePrice();

            if (!sizeSelect || !sizeSelect.value || !cartPriceInput || !cartPriceInput.value) {
                e.preventDefault();
                alert('Pilih ukuran dulu sebelum melanjutkan.');
                return;
            }

            if (branchLocationInput && !branchLocationInput.value) {
                e.preventDefault();
                alert('Pilih cabang mesin dulu sebelum melanjutkan.');
            }
        });
    }
});