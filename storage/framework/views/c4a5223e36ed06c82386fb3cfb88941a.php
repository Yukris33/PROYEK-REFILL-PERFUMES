<!doctype html>
<html lang="id">
<head>

  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title', 'SCENTCYCLE'); ?></title>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo $__env->make('partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main>
    <div id="app-content">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </main>

  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("app-content");
  if (!container) return;

  

  function loadPageCssFromDoc(doc) {
    const marker = doc.querySelector("[data-page-css]");
    if (!marker) return Promise.resolve();

    const cssUrl = marker.getAttribute("data-page-css");
    if (!cssUrl) return Promise.resolve();

    document.querySelectorAll("link[data-page-css]").forEach(l => l.remove());

    return new Promise((resolve) => {
      const link = document.createElement("link");
      link.rel = "stylesheet";
      link.href = cssUrl;
      link.setAttribute("data-page-css", "1");
      link.onload = () => resolve();
      link.onerror = () => resolve();
      document.head.appendChild(link);
    });
  }

  function initPrestigePreview() {
    const root = document.querySelector('[data-page="prestige-preview"]');
    if (!root) return;

    const sizeSelect = document.getElementById('sizeSelect');
    const priceText = document.getElementById('priceText');
    const cartSizeInput = document.getElementById('cartSizeInput');
    const cartPriceInput = document.getElementById('cartPriceInput');
    const addToCartBtn = document.getElementById('addToCartBtn');
    const addToCartForm = document.getElementById('addToCartForm');
    const buyNowBtn = document.getElementById('buyNowBtn');

    const paymentModal = document.getElementById('paymentModal');
    const closePaymentModal = document.getElementById('closePaymentModal');
    const paymentTotalText = document.getElementById('paymentTotalText');
    const paymentMethodDetail = document.getElementById('paymentMethodDetail');
    const paymentMethodButtons = document.querySelectorAll('.payment-method-btn');
    const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');

    if (!sizeSelect || !priceText || !buyNowBtn || !addToCartForm) return;

    if (root.dataset.initialized === "true") {
      updatePriceOnly();
      return;
    }
    root.dataset.initialized = "true";

    let selectedPaymentMethod = '';

    function formatRupiah(number) {
      return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(number));
    }

    function getSelectedOption() {
      return sizeSelect.options[sizeSelect.selectedIndex] || null;
    }

    function getSelectedSize() {
      return sizeSelect.value || '';
    }

    function getSelectedPrice() {
      const option = getSelectedOption();
      if (!option) return '';
      return option.dataset.price || '';
    }

    function syncInputs() {
      const size = getSelectedSize();
      const price = getSelectedPrice();

      if (cartSizeInput) cartSizeInput.value = size;
      if (cartPriceInput) cartPriceInput.value = price;
    }

    function updatePriceOnly() {
      const size = getSelectedSize();
      const price = getSelectedPrice();

      if (size && price) {
        priceText.textContent = formatRupiah(price);
      } else {
        priceText.textContent = 'Pilih ukuran dulu';
      }

      syncInputs();
    }

    function openPaymentModal() {
      const price = getSelectedPrice();

      if (paymentModal) {
        paymentModal.style.display = 'flex';
      }

      if (paymentTotalText) {
        paymentTotalText.textContent = formatRupiah(price || 0);
      }

      selectedPaymentMethod = '';

      if (paymentMethodDetail) {
        paymentMethodDetail.textContent = 'Pilih metode pembayaran dulu.';
      }

      paymentMethodButtons.forEach(function (btn) {
        btn.classList.remove('is-active');
      });
    }

    function closeModal() {
      if (paymentModal) {
        paymentModal.style.display = 'none';
      }
    }

    sizeSelect.addEventListener('change', updatePriceOnly);
    sizeSelect.addEventListener('input', updatePriceOnly);

    if (addToCartBtn) {
      addToCartBtn.addEventListener('click', function (e) {
        const size = getSelectedSize();
        const price = getSelectedPrice();

        if (!size || !price) {
          e.preventDefault();
          alert('Pilih ukuran dulu ya.');
          return;
        }

        syncInputs();
      });
    }

    buyNowBtn.addEventListener('click', function () {
      const size = getSelectedSize();
      const price = getSelectedPrice();

      if (!size || !price) {
        alert('Pilih ukuran dulu ya.');
        return;
      }

      syncInputs();
      openPaymentModal();
    });

    if (closePaymentModal) {
      closePaymentModal.addEventListener('click', closeModal);
    }

    if (paymentModal) {
      paymentModal.addEventListener('click', function (e) {
        if (e.target === paymentModal) {
          closeModal();
        }
      });
    }

    paymentMethodButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        paymentMethodButtons.forEach(function (btn) {
          btn.classList.remove('is-active');
        });

        button.classList.add('is-active');
        selectedPaymentMethod = button.dataset.method;

        let nomor = '';

        if (selectedPaymentMethod === 'Virtual Account BCA') {
          nomor = '8808123412341234';
        } else if (selectedPaymentMethod === 'Virtual Account BNI') {
          nomor = '9880012345678901';
        } else if (selectedPaymentMethod === 'Virtual Account Mandiri') {
          nomor = '7000112233445566';
        } else if (selectedPaymentMethod === 'GoPay') {
          nomor = '0812-3456-7890';
        } else if (selectedPaymentMethod === 'ShopeePay') {
          nomor = '0813-2222-1111';
        } else if (selectedPaymentMethod === 'DANA') {
          nomor = '0812-9999-8888';
        }

        if (paymentMethodDetail) {
          paymentMethodDetail.innerHTML =
            '<strong>' + selectedPaymentMethod + '</strong><br>Nomor: ' + nomor;
        }
      });
    });

    if (confirmPaymentBtn) {
      confirmPaymentBtn.addEventListener('click', function () {
        const size = getSelectedSize();
        const price = getSelectedPrice();

        if (!size || !price) {
          alert('Pilih ukuran dulu ya.');
          return;
        }

        if (!selectedPaymentMethod) {
          alert('Pilih metode pembayaran dulu ya.');
          return;
        }

        alert(
          'Pesanan berhasil dibuat.\n' +
          'Ukuran: ' + size + ' ml\n' +
          'Total: ' + formatRupiah(price) + '\n' +
          'Metode: ' + selectedPaymentMethod
        );

        closeModal();
      });
    }

    updatePriceOnly();
    setTimeout(updatePriceOnly, 100);
    setTimeout(updatePriceOnly, 300);
  }

  function initPageFeatures() {
    initPrestigePreview();
  }

  loadPageCssFromDoc(document).then(() => {
    initPageFeatures();
  });

 
});
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\perfume-projek (7)\perfume-projek\resources\views/layouts/app.blade.php ENDPATH**/ ?>