

<?php $__env->startSection('title', 'SCENTCYCLE'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/home.css?v=4')); ?>"></div>

<section class="purpose-page">

  
  <section class="purpose-hero">
    <div class="purpose-hero__bg">
      <span class="purpose-orb purpose-orb--green"></span>
      <span class="purpose-orb purpose-orb--gold"></span>
      <span class="purpose-mist purpose-mist--one"></span>
      <span class="purpose-mist purpose-mist--two"></span>
    </div>

    <div class="purpose-container purpose-hero__grid">

      <div class="purpose-hero__copy">
        <span class="purpose-eyebrow">REFILL • REUSE • REBUILD</span>

        <h1>
          Fragrance yang lebih pintar, lebih rapi, dan lebih bertanggung jawab.
        </h1>

        <p>
          ScentCycle menghadirkan konsep parfum sirkular: beli aroma favorit, isi ulang lewat smart refill station,
          gunakan kembali botol, return botol kosong, lalu dapatkan poin sebagai apresiasi.
        </p>

        <div class="purpose-hero__actions">
          <a href="<?php echo e(route('products.refill')); ?>" class="purpose-btn purpose-btn--dark">
            Mulai Refill
          </a>

          <a href="<?php echo e(route('vending.place')); ?>" class="purpose-btn purpose-btn--light">
            Cari Vending Machine
          </a>
        </div>

        <div class="purpose-hero__metrics">
          <div>
            <strong>4</strong>
            <span>Ukuran Return</span>
          </div>

          <div>
            <strong>1x24h</strong>
            <span>Validasi Poin</span>
          </div>

          <div>
            <strong>QR</strong>
            <span>Smart Pickup</span>
          </div>
        </div>
      </div>

      <div class="purpose-hero__visual">
        <div class="purpose-device">
          <div class="purpose-device__screen">
            <small>SCENTCYCLE</small>
            <strong>SMART REFILL</strong>
            <span>QR READY</span>
          </div>

          <div class="purpose-device__qr">
            <i></i><i></i><i></i>
            <i></i><i></i><i></i>
            <i></i><i></i><i></i>
          </div>

          <div class="purpose-device__nozzle"></div>
          <div class="purpose-device__laser"></div>

          <div class="purpose-device__label">
            PUT YOUR BOTTLE HERE
          </div>

          <div class="purpose-device__bay">
            <div class="purpose-bottle">
              <span></span>
              <i></i>
            </div>
          </div>

          <div class="purpose-device__sensor">
            <span>ESP32</span>
            <i></i>
          </div>

          <div class="purpose-device__points">
            +23 POINTS
          </div>
        </div>

        <div class="purpose-floating-card purpose-floating-card--one">
          <span>Return</span>
          <strong>Botol punya hidup kedua</strong>
        </div>

        <div class="purpose-floating-card purpose-floating-card--two">
          <span>Reward</span>
          <strong>Poin masuk setelah valid</strong>
        </div>
      </div>

    </div>
  </section>

  
  <section class="purpose-ecosystem">
    <div class="purpose-container">

      <div class="purpose-section-head">
        <span>SCENTCYCLE SYSTEM</span>
        <h2>Satu ekosistem dari website sampai mesin.</h2>
        <p>
          Semua dibuat supaya user bisa memilih aroma, melakukan refill, mengambil botol,
          return botol kosong, dan memantau poin dengan alur yang jelas.
        </p>
      </div>

      <div class="purpose-flow">
        <article class="purpose-flow-card">
          <div class="purpose-flow-card__num">01</div>
          <h3>Pilih Aroma</h3>
          <p>Pilih scent, ukuran refill, dan lokasi mesin langsung dari website.</p>
          <span>Website Catalog</span>
        </article>

        <article class="purpose-flow-card">
          <div class="purpose-flow-card__num">02</div>
          <h3>QR Transaction</h3>
          <p>Setelah checkout, sistem menyiapkan kode transaksi untuk validasi di mesin.</p>
          <span>QR Sync</span>
        </article>

        <article class="purpose-flow-card">
          <div class="purpose-flow-card__num">03</div>
          <h3>Smart Refill</h3>
          <p>Mesin membaca posisi botol, menyalakan sensor, lalu melakukan refill secara presisi.</p>
          <span>Sensor + Pump</span>
        </article>

        <article class="purpose-flow-card">
          <div class="purpose-flow-card__num">04</div>
          <h3>Return Bottle</h3>
          <p>Botol kosong bisa dikembalikan ke return bay untuk dicek dan diproses ulang.</p>
          <span>Circular Return</span>
        </article>

        <article class="purpose-flow-card">
          <div class="purpose-flow-card__num">05</div>
          <h3>Points Reward</h3>
          <p>Jika return valid, poin masuk ke akun dan tercatat di history pengguna.</p>
          <span>Loyalty Wallet</span>
        </article>
      </div>

    </div>
  </section>

  
  <section class="purpose-why">
    <div class="purpose-container">

      <div class="purpose-split">
        <div class="purpose-split__copy">
          <span class="purpose-eyebrow">WHY SCENTCYCLE?</span>
          <h2>Karena parfum premium nggak harus selalu berarti botol baru.</h2>
          <p>
            Parfum yang bagus bukan cuma soal wangi. Experience-nya juga harus praktis,
            tampilan tetap elegan, dan sistem setelah pemakaian tetap bertanggung jawab.
          </p>
        </div>

        <div class="purpose-split__cards">
          <article class="purpose-glass-card">
            <img src="<?php echo e(asset('img/ref.png')); ?>" alt="Refill tanpa ribet" loading="lazy">
            <div>
              <h3>Refill Tanpa Ribet</h3>
              <p>Isi ulang aroma favorit dengan proses yang lebih rapi, higienis, dan terarah.</p>
            </div>
          </article>

          <article class="purpose-glass-card">
            <img src="<?php echo e(asset('img/don.png')); ?>" alt="Rebuilt bottle" loading="lazy">
            <div>
              <h3>Rebuilt Bottle</h3>
              <p>Botol yang masih layak bisa direstorasi dan digunakan kembali tanpa kehilangan kesan premium.</p>
            </div>
          </article>

          <article class="purpose-glass-card">
            <img src="<?php echo e(asset('img/scan.png')); ?>" alt="Return bottle" loading="lazy">
            <div>
              <h3>Return & Appreciation</h3>
              <p>Return botol kosong, sistem validasi, lalu poin masuk jika botol dinyatakan valid.</p>
            </div>
          </article>
        </div>
      </div>

    </div>
  </section>

  
<section class="purpose-machine-story">
  <div class="purpose-container">
    <div class="purpose-machine-panel">

      <div class="purpose-machine-panel__left">
        <span>SMART MACHINE LOGIC</span>

        <h2>Dari QR, sensor, sampai database.</h2>

        <p>
          Mesin ScentCycle menjadi jembatan antara transaksi website dan proses fisik di vending machine.
          QR digunakan untuk membaca request, sensor membaca posisi botol, lalu data proses tersinkron ke sistem.
        </p>

        <div class="purpose-tech-grid">
          <div class="purpose-tech-card">
            <i class="purpose-tech-dot"></i>
            <div>
              <strong>QR Validation</strong>
              <small>Order dan return dicocokkan dengan database sebelum mesin berjalan.</small>
            </div>
          </div>

          <div class="purpose-tech-card">
            <i class="purpose-tech-dot"></i>
            <div>
              <strong>ESP32 Sensor</strong>
              <small>Mendeteksi botol, posisi, dan status proses refill atau return.</small>
            </div>
          </div>

          <div class="purpose-tech-card">
            <i class="purpose-tech-dot"></i>
            <div>
              <strong>Point System</strong>
              <small>Poin hanya masuk jika return berhasil dan status berubah menjadi success.</small>
            </div>
          </div>
        </div>

        <div class="purpose-machine-flow">
          <div class="purpose-machine-flow__item is-active">
            <span>01</span>
            <strong>Scan QR</strong>
          </div>

          <div class="purpose-machine-flow__line"></div>

          <div class="purpose-machine-flow__item is-active">
            <span>02</span>
            <strong>Sensor Check</strong>
          </div>

          <div class="purpose-machine-flow__line is-green"></div>

          <div class="purpose-machine-flow__item is-success">
            <span>03</span>
            <strong>Database Sync</strong>
          </div>
        </div>
      </div>

      <div class="purpose-machine-panel__right">
        <div class="purpose-mini-dashboard">
          <div class="purpose-mini-dashboard__top">
            <span>LIVE PROCESS</span>
            <strong>REFILLING...</strong>
          </div>

          <div class="purpose-progress">
            <span></span>
          </div>

          <div class="purpose-dashboard-grid">
            <div>
              <small>Status</small>
              <strong>Sensor Valid</strong>
            </div>

            <div>
              <small>Level</small>
              <strong>72%</strong>
            </div>

            <div>
              <small>Points</small>
              <strong>+15</strong>
            </div>
          </div>

          <div class="purpose-machine-visual-mini">
            <div class="purpose-mini-qr">
              <i></i><i></i><i></i>
              <i></i><i></i><i></i>
              <i></i><i></i><i></i>
            </div>

            <div class="purpose-mini-machine">
              <div class="purpose-mini-machine__screen">SCAN OK</div>
              <div class="purpose-mini-machine__laser"></div>
              <div class="purpose-mini-machine__bottle"></div>
            </div>

            <div class="purpose-mini-status">
              <span></span>
              ESP32 ONLINE
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

  
  <section class="purpose-sdg">
    <div class="purpose-container">

      <div class="purpose-section-head">
        <span>RESPONSIBLE CONSUMPTION</span>
        <h2>Sejalan dengan SDG 12 dan SDG 13.</h2>
        <p>
          ScentCycle mendukung konsumsi yang lebih bertanggung jawab lewat refill, reuse,
          return bottle, dan pengurangan kebutuhan kemasan baru secara berulang.
        </p>
      </div>

      <div class="purpose-sdg-grid">
        <article class="purpose-sdg-card">
          <div class="purpose-sdg-card__image">
            <img src="<?php echo e(asset('img/sdg12.png')); ?>" alt="SDG 12" loading="lazy">
          </div>

          <div>
            <h3>Responsible Consumption</h3>
            <p>
              Refill dan reuse membantu user mengurangi pola konsumsi sekali pakai.
              Botol tidak langsung berakhir sebagai limbah, tetapi punya peluang digunakan kembali.
            </p>
          </div>
        </article>

        <article class="purpose-sdg-card">
          <div class="purpose-sdg-card__image">
            <img src="<?php echo e(asset('img/sdg13.png')); ?>" alt="SDG 13" loading="lazy">
          </div>

          <div>
            <h3>Climate Action</h3>
            <p>
              Mengurangi kebutuhan produksi kemasan baru berarti mendukung kebiasaan konsumsi
              yang lebih efisien dan lebih sadar terhadap dampak lingkungan.
            </p>
          </div>
        </article>
      </div>

    </div>
  </section>

  
  <section class="purpose-final">
    <div class="purpose-container">
      <div class="purpose-final__card">
        <span>START YOUR CIRCULAR SCENT JOURNEY</span>
        <h2>Satu botol bisa punya cerita lebih panjang.</h2>
        <p>
          Pilih aroma, refill, return botol, dan kumpulkan poin. Semua ada dalam satu ekosistem ScentCycle.
        </p>

        <div class="purpose-final__actions">
          <a href="<?php echo e(route('products.refill')); ?>" class="purpose-btn purpose-btn--dark">
            Shop Refill
          </a>

          <a href="<?php echo e(route('products.botol')); ?>" class="purpose-btn purpose-btn--light">
            Lihat Botol
          </a>

          <a href="<?php echo e(route('return.botol')); ?>" class="purpose-btn purpose-btn--green">
            Return Botol
          </a>
        </div>
      </div>
    </div>
  </section>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\perfume-projek (7)\perfume-projek\resources\views/home.blade.php ENDPATH**/ ?>