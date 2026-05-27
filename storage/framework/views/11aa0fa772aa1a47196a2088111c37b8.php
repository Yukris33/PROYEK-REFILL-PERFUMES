

<?php $__env->startSection('title', 'Botol'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/main.css?v=120')); ?>"></div>

<?php
    $bottles = [
        [
            'slug' => 'travel-bottle-clear',
            'image' => 'img/100ml.png',
            'kicker' => 'TRAVEL CLEAR',
            'name' => 'SCENTC Travel Bottle Clear',
            'sizes' => '10ml 30ml 50ml',
        ],
        [
            'slug' => 'minimal-frost-bottle',
            'image' => 'img/botol polosan2.png',
            'kicker' => 'MINIMAL GLASS',
            'name' => 'SCENTC Minimal Frost Bottle',
            'sizes' => '20ml 30ml 50ml',
        ],
        [
            'slug' => 'premium-spray-bottle',
            'image' => 'img/1100ml.png',
            'kicker' => 'PREMIUM SPRAY',
            'name' => 'SCENTC Premium Spray Bottle',
            'sizes' => '30ml 50ml 100ml',
        ],
        [
            'slug' => 'matte-black-bottle',
            'image' => 'img/b1.png',
            'kicker' => 'MATTE BLACK',
            'name' => 'SCENTC Matte Black Bottle',
            'sizes' => '10ml 20ml 30ml',
        ],
        [
            'slug' => 'classic-round-bottle',
            'image' => 'img/b2.png',
            'kicker' => 'CLASSIC ROUND',
            'name' => 'SCENTC Classic Round Bottle',
            'sizes' => '30ml 50ml 70ml',
        ],
        [
            'slug' => 'crystal-glass-bottle',
            'image' => 'img/b3.png',
            'kicker' => 'CRYSTAL CLEAR',
            'name' => 'SCENTC Crystal Glass Bottle',
            'sizes' => '50ml 100ml',
        ],
        [
            'slug' => 'soft-pink-bottle',
            'image' => 'img/b4.png',
            'kicker' => 'SOFT PINK',
            'name' => 'SCENTC Soft Pink Bottle',
            'sizes' => '10ml 20ml 30ml',
        ],
        [
            'slug' => 'ocean-blue-bottle',
            'image' => 'img/b5.png',
            'kicker' => 'OCEAN BLUE',
            'name' => 'SCENTC Ocean Blue Bottle',
            'sizes' => '20ml 30ml 50ml',
        ],
        [
            'slug' => 'rectangle-glass-bottle',
            'image' => 'img/b6.png',
            'kicker' => 'RECTANGLE GLASS',
            'name' => 'SCENTC Rectangle Glass Bottle',
            'sizes' => '30ml 50ml 100ml',
        ],
        [
            'slug' => 'pocket-mini-bottle',
            'image' => 'img/b7.png',
            'kicker' => 'POCKET MINI',
            'name' => 'SCENTC Pocket Mini Bottle',
            'sizes' => '10ml 15ml 20ml',
        ],
        [
            'slug' => 'amber-refill-bottle',
            'image' => 'img/bottle11.png',
            'kicker' => 'AMBER GLASS',
            'name' => 'SCENTC Amber Refill Bottle',
            'sizes' => '30ml 50ml 100ml',
        ],
        [
            'slug' => 'signature-white-bottle',
            'image' => 'img/bottle12.png',
            'kicker' => 'SIGNATURE WHITE',
            'name' => 'SCENTC Signature White Bottle',
            'sizes' => '20ml 30ml 50ml',
        ],
    ];
?>

<div class="refill-page">
  <div class="catalog">
    <div class="catalog__grid">

      <?php $__currentLoopData = $bottles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bottle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="pitem pitem--bottle">
          <div class="pitem__img">
            <img src="<?php echo e(asset($bottle['image'])); ?>" alt="<?php echo e($bottle['name']); ?>">

            <div class="pitem__overlay">
              <a href="<?php echo e(route('preview.bottle', $bottle['slug'])); ?>" class="pitem__btn">
                Lihat Selengkapnya
              </a>
            </div>
          </div>

          <div class="pitem__kicker"><?php echo e($bottle['kicker']); ?></div>
          <div class="pitem__name"><?php echo e($bottle['name']); ?></div>
          <div class="pitem__price"><?php echo e($bottle['sizes']); ?></div>
        </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
  </div>
</div>

<section class="bottle-sim-section">
  <div class="bottle-sim-container">

    <div class="bottle-sim-header">
      <span class="bottle-sim-label">BOTTLE MACHINE GUIDE</span>
      <h2>Ambil Botol Baru atau Return Botol Lama</h2>
      <p>
        Gunakan smart vending machine Scentcycle untuk membeli botol kosong baru,
        atau kembalikan botol lama agar bisa diproses menjadi recrafted bottle dan mendapatkan loyalty points.
      </p>

      <div class="bottle-sim-tabs">
        <button type="button" class="bottle-sim-tab is-active" data-bottle-mode="buy">
          Beli Botol
        </button>

        <button type="button" class="bottle-sim-tab" data-bottle-mode="return">
          Return Botol + Poin
        </button>
      </div>
    </div>

    
    <div class="bottle-sim-panel is-active" data-bottle-panel="buy">
      <div class="bottle-sim-layout">

        <div class="bottle-sim-steps">
          <button type="button" class="bottle-sim-step is-active"
            data-buy-step="1"
            data-screen="SELECT BOTTLE"
            data-title="Pilih Botol"
            data-desc="Pilih botol kosong sesuai kebutuhan, mulai dari ukuran kecil untuk daily use sampai ukuran besar untuk refill jangka panjang."
            data-tags="Bottle catalog,Ukuran ml,Ready stock">
            <span>01</span>
            <div>
              <strong>Pilih Botol</strong>
              <small>Pilih ukuran dan model botol dari katalog.</small>
            </div>
          </button>

          <button type="button" class="bottle-sim-step"
            data-buy-step="2"
            data-screen="PAYMENT READY"
            data-title="Checkout & Bayar"
            data-desc="Masukkan botol ke cart atau langsung beli sekarang. Setelah checkout dan pembayaran tervalidasi, sistem menyiapkan kode QR pengambilan."
            data-tags="Checkout,QR pickup,Order paid">
            <span>02</span>
            <div>
              <strong>Checkout & Bayar</strong>
              <small>Selesaikan pembayaran lewat website.</small>
            </div>
          </button>

          <button type="button" class="bottle-sim-step"
            data-buy-step="3"
            data-screen="SCAN QR"
            data-title="Scan QR di Mesin"
            data-desc="Scan QR pengambilan pada panel mesin. Sistem akan membaca kode transaksi dan mencocokkannya dengan database order."
            data-tags="QR validation,Database sync,Secure pickup">
            <span>03</span>
            <div>
              <strong>Scan QR di Mesin</strong>
              <small>Validasi order lewat QR pengambilan.</small>
            </div>
          </button>

          <button type="button" class="bottle-sim-step"
            data-buy-step="4"
            data-screen="RELEASING"
            data-title="Botol Keluar"
            data-desc="Setelah valid, motor internal membuka slot dan botol dikeluarkan ke area pengambilan vending machine secara otomatis."
            data-tags="Motor release,Pickup bay,Auto dispense">
            <span>04</span>
            <div>
              <strong>Botol Keluar</strong>
              <small>Ambil botol dari slot pengambilan.</small>
            </div>
          </button>
        </div>

        <aside class="bottle-sim-preview">
          <div class="bottle-machine-visual buy-stage-1" id="buyBottleVisual">
            <div class="bottle-machine">
              <div class="bottle-machine__brand">SCENTCYCLE</div>

              <div class="bottle-machine__screen">
                <small>BOTTLE PICKUP</small>
                <strong id="buyBottleScreen">SELECT BOTTLE</strong>
              </div>

              <div class="bottle-machine__qr">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>

              <div class="bottle-machine__shelf">
                <div class="bottle-machine__mini-bottle bottle-a"></div>
                <div class="bottle-machine__mini-bottle bottle-b"></div>
                <div class="bottle-machine__mini-bottle bottle-c"></div>
              </div>

              <div class="bottle-machine__pickup">
                <div class="bottle-machine__pickup-door"></div>
                <div class="bottle-machine__pickup-bottle"></div>
              </div>

              <div class="bottle-machine__scan-light"></div>
              <div class="bottle-machine__status-dot"></div>
            </div>
          </div>

          <div class="bottle-sim-copy">
            <h3 id="buyBottleTitle">Pilih Botol</h3>
            <p id="buyBottleDesc">
              Pilih botol kosong sesuai kebutuhan, mulai dari ukuran kecil untuk daily use sampai ukuran besar untuk refill jangka panjang.
            </p>

            <div class="bottle-sim-tags" id="buyBottleTags">
              <span>Bottle catalog</span>
              <span>Ukuran ml</span>
              <span>Ready stock</span>
            </div>
          </div>
        </aside>

      </div>
    </div>

    
    <div class="bottle-sim-panel" data-bottle-panel="return">

      <div class="return-hero">
        <span class="return-hero__badge">CIRCULAR REWARD</span>
        <h3>Mau dapet poin dari botol kosong?</h3>
        <p>
          Jangan dibuang. Return botol lama ke mesin Scentcycle, biarkan sistem melakukan sensor check,
          lalu poin masuk ke akun kamu setelah botol dinyatakan valid.
        </p>

        <div class="return-point-card return-point-card--tier">
          <div class="return-point-tier">
            <strong>+8</strong>
            <span>20ml</span>
          </div>

          <div class="return-point-tier">
            <strong>+12</strong>
            <span>30ml</span>
          </div>

          <div class="return-point-tier">
            <strong>+15</strong>
            <span>50ml</span>
          </div>

          <div class="return-point-tier">
            <strong>+23</strong>
            <span>100ml</span>
          </div>

          <p>poin untuk botol valid yang lolos sensor & quality check</p>
        </div>

        <a href="<?php echo e(route('return.botol')); ?>" class="return-start-btn return-start-btn--hero">
          Mulai Return Botol
        </a>
      </div>

      <div class="bottle-sim-layout bottle-sim-layout--return" id="returnSimulation">

        <div class="bottle-sim-steps bottle-sim-steps--color">
          <button type="button" class="bottle-sim-step is-active"
            data-return-step="1"
            data-screen="SCAN ACCOUNT"
            data-title="Scan Akun / QR"
            data-desc="Scan QR akun atau login order history agar mesin tahu siapa pemilik botol dan ke mana poin akan dikirim."
            data-tags="User account,QR scan,Point wallet">
            <span>01</span>
            <div>
              <strong>Scan Akun / QR</strong>
              <small>Hubungkan return dengan akun pengguna.</small>
            </div>
          </button>

          <button type="button" class="bottle-sim-step"
            data-return-step="2"
            data-screen="INSERT BOTTLE"
            data-title="Masukkan Botol"
            data-desc="Masukkan botol kosong ke return bay. Slot akan menahan botol agar posisinya stabil sebelum proses pengecekan."
            data-tags="Return bay,Servo lock,Stable position">
            <span>02</span>
            <div>
              <strong>Masukkan Botol</strong>
              <small>Taruh botol di slot return bagian kanan.</small>
            </div>
          </button>

          <button type="button" class="bottle-sim-step"
            data-return-step="3"
            data-screen="SENSOR CHECK"
            data-title="Sensor Validasi"
            data-desc="Sensor membaca keberadaan botol, posisi, dan kondisi fisik dasar. ESP32 mengirim status validasi ke sistem. Jika botol valid, servo lock akan mengamankan botol agar masuk ke proses return."
            data-tags="ESP32,Sensor check,Servo lock">
            <span>03</span>
            <div>
              <strong>Sensor Validasi</strong>
              <small>Mesin mengecek botol secara otomatis.</small>
            </div>
          </button>

          <button type="button" class="bottle-sim-step"
            data-return-step="4"
            data-screen="POINT ADDED"
            data-title="Poin Masuk"
            data-desc="Jika botol valid, sistem menambahkan poin sesuai ukuran botol: 20ml mendapat 8 poin, 30ml mendapat 12 poin, 50ml mendapat 15 poin, dan 100ml mendapat 23 poin. Botol lalu masuk proses sterilisasi, QC, reconditioning, dan dapat menjadi recrafted bottle."
            data-tags="+8 / +12 / +15 / +23 poin,Recrafted bottle,Circular economy">
            <span>04</span>
            <div>
              <strong>Poin Masuk</strong>
              <small>Poin masuk sesuai ukuran botol valid.</small>
            </div>
          </button>
        </div>

        <aside class="bottle-sim-preview bottle-sim-preview--return">
          <div class="bottle-machine-visual return-stage-1" id="returnBottleVisual">
            <div class="return-machine">
              <div class="return-machine__glow"></div>

              <div class="return-machine__screen">
                <small>BOTTLE RETURN</small>
                <strong id="returnBottleScreen">SCAN ACCOUNT</strong>
              </div>

              <div class="return-machine__qr"></div>

              <div class="return-machine__return-bay">
                <div class="return-machine__slot-label">RETURN BOTTLE HERE</div>
                <div class="return-machine__door"></div>
                <div class="return-machine__bottle"></div>
                <div class="return-machine__scan-line"></div>
              </div>

              <div class="return-machine__esp">
                <span>ESP32</span>
                <i></i>
              </div>

              <div class="return-machine__points">
                POINTS ADDED
              </div>
            </div>
          </div>

          <div class="bottle-sim-copy">
            <h3 id="returnBottleTitle">Scan Akun / QR</h3>
            <p id="returnBottleDesc">
              Scan QR akun atau login order history agar mesin tahu siapa pemilik botol dan ke mana poin akan dikirim.
            </p>

            <div class="bottle-sim-tags" id="returnBottleTags">
              <span>User account</span>
              <span>QR scan</span>
              <span>Point wallet</span>
            </div>
          </div>
        </aside>

      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const modeTabs = document.querySelectorAll('[data-bottle-mode]');
  const panels = document.querySelectorAll('[data-bottle-panel]');

  function switchPanel(mode) {
    modeTabs.forEach(function(item) {
      item.classList.remove('is-active');
    });

    panels.forEach(function(panel) {
      panel.classList.remove('is-active');
    });

    const activeTab = document.querySelector('[data-bottle-mode="' + mode + '"]');
    const activePanel = document.querySelector('[data-bottle-panel="' + mode + '"]');

    if (activeTab) activeTab.classList.add('is-active');
    if (activePanel) activePanel.classList.add('is-active');
  }

  modeTabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      switchPanel(tab.dataset.bottleMode);
    });
  });

  const buySteps = document.querySelectorAll('[data-buy-step]');
  const buyVisual = document.getElementById('buyBottleVisual');
  const buyScreen = document.getElementById('buyBottleScreen');
  const buyTitle = document.getElementById('buyBottleTitle');
  const buyDesc = document.getElementById('buyBottleDesc');
  const buyTags = document.getElementById('buyBottleTags');

  buySteps.forEach(function(step) {
    step.addEventListener('click', function() {
      buySteps.forEach(function(item) {
        item.classList.remove('is-active');
      });

      step.classList.add('is-active');

      const stage = step.dataset.buyStep;
      const tags = step.dataset.tags ? step.dataset.tags.split(',') : [];

      if (buyVisual) {
        buyVisual.classList.remove('buy-stage-1', 'buy-stage-2', 'buy-stage-3', 'buy-stage-4');
        buyVisual.classList.add('buy-stage-' + stage);
      }

      if (buyScreen) buyScreen.textContent = step.dataset.screen || '';
      if (buyTitle) buyTitle.textContent = step.dataset.title || '';
      if (buyDesc) buyDesc.textContent = step.dataset.desc || '';

      if (buyTags) {
        buyTags.innerHTML = '';

        tags.forEach(function(tag) {
          const span = document.createElement('span');
          span.textContent = tag.trim();
          buyTags.appendChild(span);
        });
      }
    });
  });

  const returnSteps = document.querySelectorAll('[data-return-step]');
  const returnVisual = document.getElementById('returnBottleVisual');
  const returnScreen = document.getElementById('returnBottleScreen');
  const returnTitle = document.getElementById('returnBottleTitle');
  const returnDesc = document.getElementById('returnBottleDesc');
  const returnTags = document.getElementById('returnBottleTags');

  returnSteps.forEach(function(step) {
    step.addEventListener('click', function() {
      returnSteps.forEach(function(item) {
        item.classList.remove('is-active');
      });

      step.classList.add('is-active');

      const stage = step.dataset.returnStep;
      const tags = step.dataset.tags ? step.dataset.tags.split(',') : [];

      if (returnVisual) {
        returnVisual.classList.remove('return-stage-1', 'return-stage-2', 'return-stage-3', 'return-stage-4');
        returnVisual.classList.add('return-stage-' + stage);
      }

      if (returnScreen) returnScreen.textContent = step.dataset.screen || '';
      if (returnTitle) returnTitle.textContent = step.dataset.title || '';
      if (returnDesc) returnDesc.textContent = step.dataset.desc || '';

      if (returnTags) {
        returnTags.innerHTML = '';

        tags.forEach(function(tag) {
          const span = document.createElement('span');
          span.textContent = tag.trim();
          returnTags.appendChild(span);
        });
      }
    });
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/botol.blade.php ENDPATH**/ ?>