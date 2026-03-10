<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'SCENTCYCLE')</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  @stack('styles')
</head>
<body>

  @include('partials.header')
  @include('partials.nav')

  <main>
    <div id="app-content">
      @yield('content')
    </div>
  </main>

  @include('partials.footer')

<script>
document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("app-content");
  if (!container) return;

  if ("scrollRestoration" in history) history.scrollRestoration = "manual";

  function saveScrollForCurrentEntry() {
    const st = history.state || {};
    history.replaceState(
      { ...st, url: location.href, scrollY: window.scrollY },
      "",
      location.href
    );
  }

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

  let inFlight = null;

  async function pjaxNavigate(url, { push = true, restoreScroll = false } = {}) {
    if (inFlight) return;
    inFlight = url;

    saveScrollForCurrentEntry();

    container.classList.add("pjax-anim");
    container.classList.remove("pjax-in-from-left", "pjax-in-from-right");
    container.classList.add("pjax-out-right");

    await new Promise(r => setTimeout(r, 180));

    let res;
    try {
      res = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
    } catch {
      inFlight = null;
      window.location.href = url;
      return;
    }

    if (!res.ok) {
      inFlight = null;
      window.location.href = url;
      return;
    }

    const html = await res.text();
    const doc = new DOMParser().parseFromString(html, "text/html");

    const next = doc.querySelector("#app-content");
    if (!next) {
      inFlight = null;
      window.location.href = url;
      return;
    }

    const t = doc.querySelector("title");
    if (t) document.title = t.textContent;

    await loadPageCssFromDoc(doc);

    container.innerHTML = next.innerHTML;

    if (push) {
      history.pushState({ url, scrollY: 0 }, "", url);
    }

    if (restoreScroll) {
      const y = (history.state && typeof history.state.scrollY === "number") ? history.state.scrollY : 0;
      window.scrollTo({ top: y, behavior: "auto" });
    } else {
      window.scrollTo({ top: 0, behavior: "auto" });
    }

    initPageFeatures();

    container.classList.remove("pjax-out-right", "pjax-out-left");
    container.classList.add("pjax-in-from-right");

    requestAnimationFrame(() => {
      container.classList.remove("pjax-in-from-right");
    });

    inFlight = null;
  }

  window.addEventListener("scroll", () => {
    const st = history.state || {};
    history.replaceState({ ...st, url: location.href, scrollY: window.scrollY }, "", location.href);
  }, { passive: true });

  document.addEventListener("click", (e) => {
    const a = e.target.closest("a");
    if (!a) return;

    const href = a.getAttribute("href");
    if (!href) return;

    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
    if (href.startsWith("#")) return;
    if (a.hasAttribute("download")) return;
    if ((a.getAttribute("target") || "").toLowerCase() === "_blank") return;

    const isAbsolute = /^https?:\/\//i.test(href);
    if (isAbsolute) {
      try {
        const u = new URL(href);
        if (u.origin !== location.origin) return;
      } catch {
        return;
      }
    }

    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();

    pjaxNavigate(href, { push: true, restoreScroll: false });
  }, true);

  window.addEventListener("popstate", () => {
    pjaxNavigate(location.href, { push: false, restoreScroll: true });
  });
});
</script>

@stack('scripts')
</body>
</html>