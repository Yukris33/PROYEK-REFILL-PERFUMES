<nav class="mainnav" id="mainNav">
  <div class="mainnav__inner">

    <!-- Adjustment WRAP (biar panel nempel ke tombol) -->
    <div class="adjwrap">
      <!-- Adjustment button (ID WAJIB buat JS) -->
      <div class="navadjustment" id="adjBtn" role="button" tabindex="0" aria-controls="adjPanel" aria-expanded="false">
        <span class="navadjustment__text">Adjustment</span>
        <i class="bi bi-chevron-down navadjustment__icon"></i>
      </div>

      <!-- PANEL dipindah ke sini biar anchor ke tombol -->
      <div class="adjpanel" id="adjPanel" aria-hidden="true">
        <div class="adjpanel__inner">

          <div class="adjpanel__head">
            <div class="adjpanel__title">
              <i class="bi bi-sliders"></i>
              <span>Filter</span>
            </div>

            <button class="adjpanel__close" type="button" id="adjClose" aria-label="Close">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

         <div class="adjmenu">

  
  <div class="adjsection">
    <div class="adjsection__title">
      <i class="bi bi-droplet-half"></i>
      <span>CATEGORY</span>
    </div>

    <label class="adjitem">
      <span>Eau De Parfum</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-category" value="edp">
      </span>
    </label>

    <label class="adjitem">
      <span>Eau De Toilette</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-category" value="edt">
      </span>
    </label>

    <label class="adjitem">
      <span>Eau De Cologne</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-category" value="cologne">
      </span>
    </label>
  </div>

  <div class="adjdivider"></div>

  
  <div class="adjsection">
    <div class="adjsection__title">
      <i class="bi bi-rulers"></i>
      <span>UKURAN</span>
    </div>

    <div class="adjchips">
      <button type="button" class="adjchip" data-size="10ml">10ml</button>
      <button type="button" class="adjchip" data-size="15ml">15ml</button>
      <button type="button" class="adjchip" data-size="20ml">20ml</button>
      <button type="button" class="adjchip" data-size="25ml">25ml</button>
      <button type="button" class="adjchip" data-size="30ml">30ml</button>
      <button type="button" class="adjchip" data-size="50ml">50ml</button>
      <button type="button" class="adjchip" data-size="70ml">70ml</button>
      <button type="button" class="adjchip" data-size="100ml">100ml</button>
    </div>
  </div>

  <div class="adjdivider"></div>

  
  <div class="adjsection">
    <div class="adjsection__title">
      <i class="bi bi-stars"></i>
      <span>KARAKTER AROMA</span>
    </div>

    <label class="adjitem">
      <span>Fresh</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="fresh">
      </span>
    </label>

    <label class="adjitem">
      <span>Warm</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="warm">
      </span>
    </label>

    <label class="adjitem">
      <span>Woody</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="woody">
      </span>
    </label>

    <label class="adjitem">
      <span>Floral</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="floral">
      </span>
    </label>

    <label class="adjitem">
      <span>Citrus</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="citrus">
      </span>
    </label>

    <label class="adjitem">
      <span>Aquatic</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="aquatic">
      </span>
    </label>

    <label class="adjitem">
      <span>Gourmand</span>
      <span class="adjitem__right">
        <input type="checkbox" class="adj-aroma" value="gourmand">
      </span>
    </label>
  </div>

</div>

        <div class="adjpanel__foot">
  <div class="adjfilter-note" id="adjFilterNote">
    Filter aktif khusus katalog refill parfum.
  </div>

  <button type="button" class="adjbtn adjbtn--ghost" id="adjReset">
    <i class="bi bi-arrow-counterclockwise"></i> Reset
  </button>

  <button type="button" class="adjbtn adjbtn--primary" id="adjApply">
    <i class="bi bi-check2"></i> Apply
  </button>
</div>

        </div> 
      </div> 
    </div> 
    <!-- /adjwrap -->

<a href="<?php echo e(route('history.index')); ?>" class="navlink navlink-history nav-spray">
  History
</a>

<!-- NAV LINKS -->
<a href="<?php echo e(route('home')); ?>" class="navlink navlink-main nav-spray">Purpose's</a>
<a href="<?php echo e(route('nav.brand')); ?>" class="navlink navlink-main nav-spray">Brand</a>
<a href="<?php echo e(route('products.botol')); ?>" class="navlink navlink-main nav-spray">Botol</a>
<a href="<?php echo e(route('vending.place')); ?>" class="navlink navlink-main nav-spray">Vending Mechine & Place</a>
<a href="<?php echo e(route('nav.voucher-bantuan')); ?>" class="navlink navlink-main nav-spray">Voucher & Bantuan</a>
<!-- GLOBAL QUICK SEARCH -->
<div class="navsearch" id="globalSearchWrap">
  <i class="bi bi-search navsearch__icon"></i>

  <input
    type="text"
    class="navsearch__input"
    id="globalSearchInput"
    placeholder="Cari halaman atau produk..."
    autocomplete="off"
  >

  <div class="navsearch-results" id="globalSearchResults" hidden>
    <div class="navsearch-results__head">
      <span>Quick Finder</span>
      <small id="globalSearchHint">Ketik untuk mencari</small>
    </div>

    <div class="navsearch-results__list" id="globalSearchList"></div>
  </div>
</div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('adjBtn');
  const panel = document.getElementById('adjPanel');
  const closeBtn = document.getElementById('adjClose');

  if (btn && panel) {
    const chevron = btn.querySelector('.navadjustment__icon');

    function openPanel(){
      panel.classList.add('is-open');
      panel.setAttribute('aria-hidden','false');
      chevron?.classList.add('is-rot');
      btn.setAttribute('aria-expanded','true');
    }

    function closePanel(){
      panel.classList.remove('is-open');
      panel.setAttribute('aria-hidden','true');
      chevron?.classList.remove('is-rot');
      btn.setAttribute('aria-expanded','false');
    }

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      panel.classList.contains('is-open') ? closePanel() : openPanel();
    });

    closeBtn?.addEventListener('click', (e) => {
      e.stopPropagation();
      closePanel();
    });

    document.addEventListener('click', (e) => {
      if(panel.classList.contains('is-open') && !panel.contains(e.target) && !btn.contains(e.target)){
        closePanel();
      }
    });

    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape') closePanel();
    });
  }

  document.querySelectorAll('.adjchip').forEach(chip => {
    chip.addEventListener('click', () => {
      chip.classList.toggle('is-active');
    });
  });

  const applyBtn = document.getElementById('adjApply');
const resetBtn = document.getElementById('adjReset');
const filterNote = document.getElementById('adjFilterNote');

function applyRefillFilter() {
  const cards = document.querySelectorAll('.pitem');
  const emptyState = document.getElementById('catalogFilterEmpty');

  if (!cards.length) {
    if (filterNote) {
      filterNote.textContent = 'Filter ini dipakai di halaman refill parfum.';
    }
    return;
  }

  const selectedCategories = Array.from(
    document.querySelectorAll('.adj-category:checked')
  ).map(item => item.value);

  const selectedAromas = Array.from(
    document.querySelectorAll('.adj-aroma:checked')
  ).map(item => item.value);

  const selectedSizes = Array.from(
    document.querySelectorAll('.adjchip.is-active')
  ).map(item => item.dataset.size);

  let visibleCount = 0;

  cards.forEach(card => {
    const category = card.dataset.category || '';
    const sizes = (card.dataset.sizes || '').split('|').filter(Boolean);
    const aromas = (card.dataset.aromas || '').split('|').filter(Boolean);

    const categoryMatch =
      selectedCategories.length === 0 ||
      selectedCategories.includes(category);

    const sizeMatch =
      selectedSizes.length === 0 ||
      selectedSizes.some(size => sizes.includes(size));

    const aromaMatch =
      selectedAromas.length === 0 ||
      selectedAromas.some(aroma => aromas.includes(aroma));

    const shouldShow = categoryMatch && sizeMatch && aromaMatch;

    card.style.display = shouldShow ? '' : 'none';

    if (shouldShow) {
      visibleCount++;
    }
  });

  if (emptyState) {
    emptyState.hidden = visibleCount !== 0;
  }

  if (filterNote) {
    filterNote.textContent = visibleCount + ' produk cocok dengan filter.';
  }
}

function resetRefillFilter() {
  document.querySelectorAll('.adj-category, .adj-aroma').forEach(input => {
    input.checked = false;
  });

  document.querySelectorAll('.adjchip').forEach(chip => {
    chip.classList.remove('is-active');
  });

  document.querySelectorAll('.pitem').forEach(card => {
    card.style.display = '';
  });

  const emptyState = document.getElementById('catalogFilterEmpty');

  if (emptyState) {
    emptyState.hidden = true;
  }

  if (filterNote) {
    filterNote.textContent = 'Filter aktif khusus katalog refill parfum.';
  }
}

applyBtn?.addEventListener('click', applyRefillFilter);
resetBtn?.addEventListener('click', resetRefillFilter);

  document.querySelectorAll('.nav-spray').forEach(link => {
    link.addEventListener('pointerdown', function(e) {
      const rect = link.getBoundingClientRect();
      const startX = e.clientX || (rect.left + rect.width / 2);
      const startY = e.clientY || (rect.top + rect.height / 2);

      for (let i = 0; i < 12; i++) {
        const particle = document.createElement('span');
        particle.className = 'nav-spray-particle';

        const angle = (-35 + Math.random() * 70) * Math.PI / 180;
        const distance = 28 + Math.random() * 46;

        const x = Math.cos(angle) * distance;
        const y = Math.sin(angle) * distance - 16;

        particle.style.left = startX + 'px';
        particle.style.top = startY + 'px';
        particle.style.setProperty('--spray-x', x + 'px');
        particle.style.setProperty('--spray-y', y + 'px');

        document.body.appendChild(particle);

        setTimeout(() => {
          particle.remove();
        }, 760);
      }
    });
  });
    /* =========================================
     GLOBAL QUICK FINDER SEARCH
  ========================================= */

  const globalSearchWrap = document.getElementById('globalSearchWrap');
  const globalSearchInput = document.getElementById('globalSearchInput');
  const globalSearchResults = document.getElementById('globalSearchResults');
  const globalSearchList = document.getElementById('globalSearchList');
  const globalSearchHint = document.getElementById('globalSearchHint');

  const quickFinderData = [
    // =========================
    // HALAMAN
    // =========================
    {
      type: 'Halaman',
      title: 'Purpose’s',
      subtitle: 'Halaman utama SCENTCYCLE',
      keywords: ['home', 'purpose', 'purposes', 'beranda', 'utama'],
      url: "<?php echo e(route('home')); ?>",
      icon: 'bi-house-door'
    },
    {
      type: 'Halaman',
      title: 'Brand',
      subtitle: 'Katalog brand / parfum',
      keywords: ['brand', 'parfum', 'refill'],
      url: "<?php echo e(route('nav.brand')); ?>",
      icon: 'bi-stars'
    },
    {
      type: 'Halaman',
      title: 'Botol',
      subtitle: 'Katalog botol kosong refill',
      keywords: ['botol', 'bottle', 'empty bottle', 'botol kosong'],
      url: "<?php echo e(route('products.botol')); ?>",
      icon: 'bi-droplet'
    },
    {
      type: 'Halaman',
      title: 'Vending Machine & Place',
      subtitle: 'Lokasi dan informasi vending machine',
      keywords: ['vending', 'machine', 'lokasi', 'place', 'mesin'],
      url: "<?php echo e(route('vending.place')); ?>",
      icon: 'bi-cpu'
    },
    {
      type: 'Halaman',
      title: 'Voucher & Bantuan',
      subtitle: 'Voucher, poin, support ticket, kerja sama',
      keywords: ['voucher', 'bantuan', 'poin', 'points', 'kendala', 'kerja sama'],
      url: "<?php echo e(route('nav.voucher-bantuan')); ?>",
      icon: 'bi-ticket-perforated'
    },
    {
      type: 'Halaman',
      title: 'History',
      subtitle: 'Riwayat pesanan customer',
      keywords: ['history', 'riwayat', 'pesanan', 'order'],
      url: "<?php echo e(route('history.index')); ?>",
      icon: 'bi-clock-history'
    },

    // =========================
    // PRODUK REFILL
    // =========================
    {
      type: 'Refill Parfum',
      title: 'SCENTC Prestige Signature',
      subtitle: 'Warm · Eau De Parfum',
      keywords: ['prestige', 'signature', 'warm', 'eau de parfum', 'edp'],
      url: "<?php echo e(route('preview.prestige')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Ocean Breeze Aqua',
      subtitle: 'Fresh · Aquatic · Eau De Parfum',
      keywords: ['ocean', 'breeze', 'aqua', 'fresh', 'aquatic', 'edp'],
      url: "<?php echo e(route('preview.ocean')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Midnight Oud Intense',
      subtitle: 'Woody · Warm · Eau De Parfum',
      keywords: ['midnight', 'oud', 'intense', 'woody', 'warm', 'edp'],
      url: "<?php echo e(route('preview.midnight')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Citrus Aura Fresh',
      subtitle: 'Citrus · Fresh · Eau De Cologne',
      keywords: ['citrus', 'aura', 'fresh', 'cologne'],
      url: "<?php echo e(route('preview.citrus')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Velvet Bloom',
      subtitle: 'Floral · Eau De Toilette',
      keywords: ['velvet', 'bloom', 'floral', 'edt'],
      url: "<?php echo e(route('preview.velvet')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Vanilla Suede',
      subtitle: 'Warm · Gourmand · Eau De Parfum',
      keywords: ['vanilla', 'suede', 'warm', 'gourmand', 'edp'],
      url: "<?php echo e(route('preview.vanilla')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Silver Mist',
      subtitle: 'Fresh · Woody · Eau De Toilette',
      keywords: ['silver', 'mist', 'fresh', 'woody', 'edt'],
      url: "<?php echo e(route('preview.silver')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Blue Neroli',
      subtitle: 'Fresh · Citrus · Eau De Toilette',
      keywords: ['blue', 'neroli', 'fresh', 'citrus', 'edt'],
      url: "<?php echo e(route('preview.blue')); ?>",
      icon: 'bi-droplet-half'
    },
    {
      type: 'Refill Parfum',
      title: 'SCENTC Emerald Cedar',
      subtitle: 'Woody · Eau De Parfum',
      keywords: ['emerald', 'cedar', 'woody', 'edp'],
      url: "<?php echo e(route('preview.emerald')); ?>",
      icon: 'bi-droplet-half'
    },

    // =========================
    // PRODUK BOTOL
    // =========================
    {
      type: 'Botol',
      title: 'SCENTC Travel Bottle Clear',
      subtitle: 'Portable · Clear · Lightweight',
      keywords: ['travel', 'clear', 'bottle', 'botol travel'],
      url: "<?php echo e(route('preview.bottle', 'travel-bottle-clear')); ?>",
      icon: 'bi-cup-straw'
    },
    {
      type: 'Botol',
      title: 'SCENTC Minimal Frost Bottle',
      subtitle: 'Minimal · Frosted · Clean',
      keywords: ['minimal', 'frost', 'frosted', 'clean', 'bottle'],
      url: "<?php echo e(route('preview.bottle', 'minimal-frost-bottle')); ?>",
      icon: 'bi-cup-straw'
    },
    {
      type: 'Botol',
      title: 'SCENTC Classic Round Bottle',
      subtitle: 'Classic · Rounded · Timeless',
      keywords: ['classic', 'round', 'botol bulat', 'bottle'],
      url: "<?php echo e(route('preview.bottle', 'classic-round-bottle')); ?>",
      icon: 'bi-cup-straw'
    },
    {
      type: 'Botol',
      title: 'SCENTC Premium Spray Bottle',
      subtitle: 'Premium · Elegant · Daily Use',
      keywords: ['premium', 'spray', 'bottle', 'elegant'],
      url: "<?php echo e(route('preview.bottle', 'premium-spray-bottle')); ?>",
      icon: 'bi-cup-straw'
    },
    {
      type: 'Botol',
      title: 'SCENTC Matte Black Bottle',
      subtitle: 'Bold · Dark · Modern',
      keywords: ['matte', 'black', 'dark', 'modern', 'bottle'],
      url: "<?php echo e(route('preview.bottle', 'matte-black-bottle')); ?>",
      icon: 'bi-cup-straw'
    }
  ];

  function normalizeSearchText(text) {
    return String(text || '').toLowerCase().trim();
  }

  function getMatchedQuickFinderItems(query) {
    const keyword = normalizeSearchText(query);

    if (!keyword) {
      return quickFinderData.slice(0, 6);
    }

    return quickFinderData.filter(item => {
      const searchableText = [
        item.type,
        item.title,
        item.subtitle,
        ...(item.keywords || [])
      ].join(' ').toLowerCase();

      return searchableText.includes(keyword);
    }).slice(0, 8);
  }

  function renderQuickFinderResults(query = '') {
    if (!globalSearchList || !globalSearchResults) return;

    const results = getMatchedQuickFinderItems(query);
    globalSearchList.innerHTML = '';

    if (globalSearchHint) {
      globalSearchHint.textContent = query
        ? results.length + ' hasil ditemukan'
        : 'Shortcut cepat';
    }

    if (!results.length) {
      globalSearchList.innerHTML = `
        <div class="navsearch-empty">
          <i class="bi bi-search"></i>
          <strong>Tidak ada hasil.</strong>
          <span>Coba kata lain, misalnya voucher, ocean, botol, atau history.</span>
        </div>
      `;

      globalSearchResults.hidden = false;
      return;
    }

    results.forEach((item, index) => {
      const link = document.createElement('a');
      link.href = item.url;
      link.className = 'navsearch-result-item';
      link.dataset.index = index;

      link.innerHTML = `
        <span class="navsearch-result-icon">
          <i class="bi ${item.icon}"></i>
        </span>

        <span class="navsearch-result-copy">
          <small>${item.type}</small>
          <strong>${item.title}</strong>
          <em>${item.subtitle}</em>
        </span>

        <i class="bi bi-arrow-up-right navsearch-result-arrow"></i>
      `;

      globalSearchList.appendChild(link);
    });

    globalSearchResults.hidden = false;
  }

  function closeQuickFinder() {
    if (globalSearchResults) {
      globalSearchResults.hidden = true;
    }
  }

  globalSearchInput?.addEventListener('focus', function () {
    renderQuickFinderResults(globalSearchInput.value);
  });

  globalSearchInput?.addEventListener('input', function () {
    renderQuickFinderResults(globalSearchInput.value);
  });

  globalSearchInput?.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
      const firstResult = globalSearchList?.querySelector('.navsearch-result-item');

      if (firstResult) {
        e.preventDefault();
        window.location.href = firstResult.href;
      }
    }

    if (e.key === 'Escape') {
      closeQuickFinder();
      globalSearchInput.blur();
    }
  });

  document.addEventListener('click', function (e) {
    if (
      globalSearchWrap &&
      !globalSearchWrap.contains(e.target)
    ) {
      closeQuickFinder();
    }
  });
  
});
</script>
<?php /**PATH C:\xampp\htdocs\perfume-projek (7)\perfume-projek\resources\views/partials/nav.blade.php ENDPATH**/ ?>