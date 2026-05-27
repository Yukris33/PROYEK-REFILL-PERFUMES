

<?php $__env->startSection('title', 'Vending Mechine & Place - SCENTCYCLE'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/vending-place.css')); ?>" data-page-css="<?php echo e(asset('css/vending-place.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="vp-page">
  <div class="vp-container">
    <div class="vp-sheet">

      
<section class="vp-machine-showcase">
  <div class="vp-machine-hero">
    <div class="vp-machine-hero__copy">
      <p class="vp-label">VENDING MACHINE SYSTEM</p>
      <h1 class="vp-title">SCENTCYCLE Smart Fragrance Refill Station</h1>

      <p class="vp-machine-lead">
        Mesin refill parfum pintar yang menghubungkan pembelian digital, validasi QR,
        pengisian otomatis, pengembalian botol, dan monitoring operasional berbasis IoT.
      </p>

      <p class="vp-machine-chip-label">Core Features</p>
      <div class="vp-machine-chips">
        <span>ESP32 Controlled</span>
        <span>QR Validation</span>
        <span>Auto Refill</span>
        <span>Bottle Return</span>
        <span>IoT Monitoring</span>
      </div>
    </div>

    <div class="vp-machine-stats">
      <div>
        <strong>1–2 Min</strong>
        <span>Process Time</span>
      </div>
      <div>
        <strong>24/7</strong>
        <span>Monitoring</span>
      </div>
      <div>
        <strong>3+</strong>
        <span>Sensor System</span>
      </div>
    </div>
  </div>

  <div class="vp-machine-tabs">
    <button type="button" class="vp-machine-tab is-active" data-machine="front">
      Front View
    </button>
    <button type="button" class="vp-machine-tab" data-machine="back">
      Back View
    </button>
    <button type="button" class="vp-machine-tab" data-machine="left">
      Left Side
    </button>
    <button type="button" class="vp-machine-tab" data-machine="right">
      Right Side
    </button>
    <button type="button" class="vp-machine-tab" data-machine="panel">
      Front Panel
    </button>
  </div>

  <div class="vp-machine-grid">
    <div class="vp-machine-media">
      <img id="vpMachineImage" src="<?php echo e(asset('img/depan.png')); ?>" alt="SCENTCYCLE Front View">
    </div>

    <div class="vp-machine-detail">
      <p class="vp-label" id="vpMachineLabel">FRONT VIEW</p>
      <h2 class="vp-subtitle" id="vpMachineTitle">
        Tampilan Utama Mesin Refill yang Intuitif
      </h2>

      <p class="vp-machine-desc" id="vpMachineDesc">
        Tampilan depan mesin SCENTCYCLE menampilkan area scan, instruksi penggunaan,
        indikator volume, area refill, test spray, dan kompartemen return bottle dalam satu
        panel yang mudah dipahami pengguna.
      </p>

      <div class="vp-machine-feature-list" id="vpMachineFeatures">
        <span>Scan QR</span>
        <span>Refill Area</span>
        <span>Test Spray</span>
        <span>Bottle Return</span>
      </div>

      <button type="button" class="vp-machine-detail-btn" id="vpMachineDetailBtn">
        Lihat Detail Teknis
      </button>

      <div class="vp-machine-technical" id="vpMachineTechnical">
        <p id="vpMachineTechnicalText">
          Panel depan dikontrol oleh mikrokontroler ESP32 yang menerima input dari barcode scanner,
          sensor posisi botol, sensor volume refill, dan indikator LED. Sistem kemudian mengatur proses
          refill agar berjalan secara otomatis, higienis, dan terkoordinasi.
        </p>
      </div>
    </div>
  </div>
</section>


<section class="vp-process-section">
  <div class="vp-process-head">
    <p class="vp-label">SYSTEM FLOW</p>
    <h2 class="vp-subtitle">Alur Kerja Mesin SCENTCYCLE</h2>
    <p>
      Proses refill dibuat sederhana agar pengguna dapat melakukan transaksi digital,
      validasi QR, pengisian parfum, hingga pengembalian botol dalam satu sistem terintegrasi.
    </p>
  </div>

  <div class="vp-process-grid">
    <div class="vp-process-card">
      <span>01</span>
      <h3>Scan QR</h3>
      <p>Pengguna memindai QR refill dari website untuk memulai validasi transaksi.</p>
    </div>

    <div class="vp-process-card">
      <span>02</span>
      <h3>Validate Order</h3>
      <p>Sistem mengecek kode transaksi, status pembayaran, dan data refill yang aktif.</p>
    </div>

    <div class="vp-process-card">
      <span>03</span>
      <h3>Bottle Detection</h3>
      <p>Sensor membaca posisi botol untuk memastikan botol berada di area refill.</p>
    </div>

    <div class="vp-process-card">
      <span>04</span>
      <h3>Auto Refill</h3>
      <p>Pompa parfum bekerja otomatis sesuai ukuran refill yang telah dipilih pengguna.</p>
    </div>

    <div class="vp-process-card">
      <span>05</span>
      <h3>Data Monitoring</h3>
      <p>Data refill, stok fragrance, dan return bottle dikirim ke sistem website.</p>
    </div>
  </div>
</section>

      
<section class="vp-location-section">
  <div class="vp-location-head">
    <p class="vp-label">LOCATION</p>
    <h2 class="vp-subtitle">Lokasi Mesin SCENTCYCLE</h2>
    <p>
      Pilih cabang mesin SCENTCYCLE untuk melihat lokasi, status operasional, dan informasi singkat setiap titik penempatan.
    </p>
  </div>

  <div class="vp-location-tabs">
    <button type="button" class="vp-location-tab is-active" data-location="umn">
      UMN
    </button>

    <button type="button" class="vp-location-tab" data-location="sms">
      Summarecon Mall Serpong
    </button>

    <button type="button" class="vp-location-tab" data-location="aeon">
      AEON Mall BSD
    </button>
  </div>

  <div class="vp-location-grid">
    <div class="vp-media vp-media--map">
      <div class="vp-map-frame">
        <iframe
          id="vpLocationMap"
          src="https://www.google.com/maps?q=Universitas%20Multimedia%20Nusantara&z=17&output=embed"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

    <div class="vp-text vp-location-detail">
      <p class="vp-label" id="vpLocationLabel">MAIN STATION</p>
      <h2 class="vp-subtitle" id="vpLocationTitle">Universitas Multimedia Nusantara</h2>

      <div class="vp-location-address" id="vpLocationAddress">
        Jl. Scientia Boulevard, Gading Serpong, Tangerang
      </div>

      <div class="vp-location-chips">
        <span id="vpLocationStatus">Aktif</span>
        <span id="vpLocationHours">08.00 - 20.00</span>
        <span id="vpLocationPayment">QRIS, VA, E-Wallet</span>
        <span id="vpLocationService">Refill & Recycle</span>
      </div>

      <div class="vp-copy">
        <p id="vpLocationDesc1">
          Mesin SCENTCYCLE ditempatkan di area Kampus Universitas Multimedia Nusantara (UMN) sebagai bagian dari simulasi penempatan mesin pada lingkungan publik yang memiliki aktivitas pengguna tinggi. Lokasi ini dipilih karena mahasiswa dan komunitas kampus umumnya terbiasa dengan teknologi digital serta terbuka terhadap konsep layanan inovatif.
        </p>

        <p id="vpLocationDesc2">
          Melalui sistem berbasis IoT dan mikrokontroler ESP32, mesin dapat melakukan monitoring operasional seperti jumlah refill parfum, sisa stok fragrance, serta jumlah botol bekas yang dikembalikan oleh pengguna. Informasi tersebut dapat diakses melalui sistem website sehingga pengelolaan mesin dapat dilakukan secara lebih efisien.
        </p>

        <p id="vpLocationDesc3">
          Selain berfungsi sebagai perangkat refill parfum, mesin ini juga berperan sebagai media edukasi mengenai konsep refill dan pengelolaan botol bekas sebagai bagian dari gaya hidup yang lebih berkelanjutan di lingkungan kampus.
        </p>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    /*
    |--------------------------------------------------------------------------
    | MACHINE SHOWCASE TAB
    |--------------------------------------------------------------------------
    */
    const machineData = {
      front: {
        image: "<?php echo e(asset('img/depan.png')); ?>",
        label: "FRONT VIEW",
        title: "Tampilan Utama Mesin Refill yang Intuitif",
        desc: "Tampilan depan mesin SCENTCYCLE menampilkan area scan, instruksi penggunaan, indikator volume, area refill, test spray, dan kompartemen return bottle dalam satu panel yang mudah dipahami pengguna.",
        features: ["Scan QR", "Refill Area", "Test Spray", "Bottle Return"],
        technical: "Panel depan dikontrol oleh mikrokontroler ESP32 yang menerima input dari barcode scanner, sensor posisi botol, sensor volume refill, dan indikator LED. Sistem kemudian mengatur proses refill agar berjalan secara otomatis, higienis, dan terkoordinasi."
      },

      back: {
        image: "<?php echo e(asset('img/pbelakang.png')); ?>",
        label: "BACK VIEW",
        title: "Panel Konektivitas untuk Sistem IoT",
        desc: "Bagian belakang mesin menyediakan konektivitas seperti power supply, ethernet, USB service, antena WiFi, SIM slot, dan tombol reset untuk mendukung monitoring serta perawatan perangkat.",
        features: ["Power Supply", "Ethernet", "WiFi Antenna", "Service Port"],
        technical: "Panel belakang mempermudah teknisi melakukan pengecekan, perawatan, dan troubleshooting tanpa mengganggu area interaksi utama pengguna. Konektivitas ini juga mendukung pengiriman data operasional ke website."
      },

      left: {
        image: "<?php echo e(asset('img/pkiri.png')); ?>",
        label: "LEFT SIDE",
        title: "Fragrance Storage untuk Operasional Refill",
        desc: "Sisi kiri mesin berfungsi sebagai ruang penyimpanan tangki parfum dari berbagai varian fragrance yang akan disalurkan ke sistem dispenser.",
        features: ["Fragrance Tank", "Stock Sensor", "Service Access", "Auto Supply"],
        technical: "Setiap tangki parfum dapat dipantau melalui sensor level cairan yang terhubung dengan ESP32. Data stok dapat dikirim ke website agar operator mengetahui kondisi fragrance tanpa membuka mesin secara langsung."
      },

      right: {
        image: "<?php echo e(asset('img/pkanan.png')); ?>",
        label: "RIGHT SIDE",
        title: "Area Refill dan Unused Bottle yang Terpisah",
        desc: "Sisi kanan mesin memisahkan area refill support dan kompartemen unused bottle agar alur penggunaan lebih jelas dan sistem internal bekerja lebih terstruktur.",
        features: ["Refill Support", "Unused Bottle", "IR Sensor", "Bottle Counter"],
        technical: "Kompartemen unused bottle dilengkapi sensor infrared untuk mendeteksi botol bekas yang dimasukkan pengguna. Data jumlah botol diproses oleh ESP32 dan digunakan sebagai bagian dari monitoring return bottle."
      },

      panel: {
        image: "<?php echo e(asset('img/depanbener.png')); ?>",
        label: "FRONT PANEL",
        title: "Panel Interaksi Utama untuk Pengalaman Refill",
        desc: "Panel depan menjadi pusat interaksi pengguna, mulai dari validasi QR, instruksi penggunaan, test spray, proses refill, hingga pengambilan botol dari slot mesin.",
        features: ["QR Scanner", "Instruction Panel", "Volume Indicator", "Bottle Slot"],
        technical: "Sistem mengatur kerja aktuator seperti pompa parfum, indikator LED, dan motor pendorong botol. Proses validasi hingga pengambilan botol membutuhkan waktu sekitar 1–2 menit setelah transaksi dinyatakan valid."
      }
    };

    const machineTabs = document.querySelectorAll('.vp-machine-tab');
    const machineImage = document.getElementById('vpMachineImage');
    const machineLabel = document.getElementById('vpMachineLabel');
    const machineTitle = document.getElementById('vpMachineTitle');
    const machineDesc = document.getElementById('vpMachineDesc');
    const machineFeatures = document.getElementById('vpMachineFeatures');
    const machineTechnicalText = document.getElementById('vpMachineTechnicalText');
    const machineTechnicalBox = document.getElementById('vpMachineTechnical');
    const machineDetailBtn = document.getElementById('vpMachineDetailBtn');

    if (
      machineTabs.length &&
      machineImage &&
      machineLabel &&
      machineTitle &&
      machineDesc &&
      machineFeatures &&
      machineTechnicalText &&
      machineTechnicalBox &&
      machineDetailBtn
    ) {
      machineTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          const key = this.dataset.machine;
          const data = machineData[key];

          if (!data) return;

          machineTabs.forEach(function (item) {
            item.classList.remove('is-active');
          });

          this.classList.add('is-active');

          machineImage.src = data.image;
          machineImage.alt = data.title;
          machineLabel.textContent = data.label;
          machineTitle.textContent = data.title;
          machineDesc.textContent = data.desc;
          machineTechnicalText.textContent = data.technical;

          machineFeatures.innerHTML = '';

          data.features.forEach(function (feature) {
            const span = document.createElement('span');
            span.textContent = feature;
            machineFeatures.appendChild(span);
          });

          machineTechnicalBox.classList.remove('is-open');
          machineDetailBtn.textContent = 'Lihat Detail Teknis';
        });
      });

      machineDetailBtn.addEventListener('click', function () {
        machineTechnicalBox.classList.toggle('is-open');

        if (machineTechnicalBox.classList.contains('is-open')) {
          machineDetailBtn.textContent = 'Sembunyikan Detail Teknis';
        } else {
          machineDetailBtn.textContent = 'Lihat Detail Teknis';
        }
      });
    }

    /*
    |--------------------------------------------------------------------------
    | LOCATION SWITCHER
    |--------------------------------------------------------------------------
    */
    const locations = {
      umn: {
        label: 'MAIN STATION',
        title: 'Universitas Multimedia Nusantara',
        address: 'Jl. Scientia Boulevard, Gading Serpong, Tangerang',
        map: 'https://www.google.com/maps?q=Universitas%20Multimedia%20Nusantara&z=17&output=embed',
        status: 'Aktif',
        hours: '08.00 - 20.00',
        payment: 'QRIS, VA, E-Wallet',
        service: 'Refill & Recycle',
        desc1: 'Mesin SCENTCYCLE ditempatkan di area Kampus Universitas Multimedia Nusantara (UMN) sebagai bagian dari simulasi penempatan mesin pada lingkungan publik yang memiliki aktivitas pengguna tinggi. Lokasi ini dipilih karena mahasiswa dan komunitas kampus umumnya terbiasa dengan teknologi digital serta terbuka terhadap konsep layanan inovatif.',
        desc2: 'Melalui sistem berbasis IoT dan mikrokontroler ESP32, mesin dapat melakukan monitoring operasional seperti jumlah refill parfum, sisa stok fragrance, serta jumlah botol bekas yang dikembalikan oleh pengguna. Informasi tersebut dapat diakses melalui sistem website sehingga pengelolaan mesin dapat dilakukan secara lebih efisien.',
        desc3: 'Selain berfungsi sebagai perangkat refill parfum, mesin ini juga berperan sebagai media edukasi mengenai konsep refill dan pengelolaan botol bekas sebagai bagian dari gaya hidup yang lebih berkelanjutan di lingkungan kampus.'
      },

      sms: {
        label: 'MALL STATION',
        title: 'Summarecon Mall Serpong',
        address: 'Summarecon Mall Serpong, Gading Serpong, Tangerang',
        map: 'https://www.google.com/maps?q=Summarecon%20Mall%20Serpong&z=17&output=embed',
        status: 'Aktif',
        hours: '10.00 - 22.00',
        payment: 'QRIS, VA, E-Wallet',
        service: 'Refill Available',
        desc1: 'Cabang SCENTCYCLE di Summarecon Mall Serpong dirancang untuk menjangkau pengguna di area pusat perbelanjaan yang memiliki minat terhadap produk lifestyle, personal care, dan pengalaman belanja modern.',
        desc2: 'Lokasi ini dipilih karena memiliki traffic pengunjung yang tinggi serta cocok untuk memperkenalkan layanan refill parfum yang cepat, praktis, dan berbasis self-service. Pengguna dapat melakukan transaksi melalui website, lalu menggunakan QR refill pada mesin.',
        desc3: 'Penempatan mesin di area mall juga memperluas jangkauan SCENTCYCLE kepada pengguna umum, bukan hanya lingkungan kampus, sehingga konsep refill parfum dan pengurangan botol sekali pakai dapat dikenalkan ke pasar yang lebih luas.'
      },

      aeon: {
        label: 'COMMERCIAL STATION',
        title: 'AEON Mall BSD',
        address: 'AEON Mall BSD City, Tangerang Selatan',
        map: 'https://www.google.com/maps?q=AEON%20Mall%20BSD%20City&z=17&output=embed',
        status: 'Aktif',
        hours: '10.00 - 22.00',
        payment: 'QRIS, VA, E-Wallet',
        service: 'Refill Available',
        desc1: 'Cabang SCENTCYCLE di AEON Mall BSD menjadi alternatif lokasi komersial dengan target pengguna keluarga muda, pekerja urban, dan pengunjung mall yang terbiasa dengan layanan digital modern.',
        desc2: 'Lokasi ini mendukung konsep ekspansi layanan refill parfum di area publik yang nyaman dan mudah diakses. Dengan sistem pembayaran digital dan validasi QR, proses refill dapat dilakukan secara mandiri tanpa antre panjang.',
        desc3: 'Penempatan di AEON Mall BSD memperkuat citra SCENTCYCLE sebagai layanan refill parfum yang modern, praktis, dan relevan untuk gaya hidup urban yang lebih efisien serta berkelanjutan.'
      }
    };

    const locationTabs = document.querySelectorAll('.vp-location-tab');
    const locationMap = document.getElementById('vpLocationMap');
    const locationLabel = document.getElementById('vpLocationLabel');
    const locationTitle = document.getElementById('vpLocationTitle');
    const locationAddress = document.getElementById('vpLocationAddress');
    const locationStatus = document.getElementById('vpLocationStatus');
    const locationHours = document.getElementById('vpLocationHours');
    const locationPayment = document.getElementById('vpLocationPayment');
    const locationService = document.getElementById('vpLocationService');
    const locationDesc1 = document.getElementById('vpLocationDesc1');
    const locationDesc2 = document.getElementById('vpLocationDesc2');
    const locationDesc3 = document.getElementById('vpLocationDesc3');

    if (
      locationTabs.length &&
      locationMap &&
      locationLabel &&
      locationTitle &&
      locationAddress &&
      locationStatus &&
      locationHours &&
      locationPayment &&
      locationService &&
      locationDesc1 &&
      locationDesc2 &&
      locationDesc3
    ) {
      locationTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          const key = this.dataset.location;
          const data = locations[key];

          if (!data) return;

          locationTabs.forEach(function (item) {
            item.classList.remove('is-active');
          });

          this.classList.add('is-active');

          locationMap.src = data.map;
          locationLabel.textContent = data.label;
          locationTitle.textContent = data.title;
          locationAddress.textContent = data.address;
          locationStatus.textContent = data.status;
          locationHours.textContent = data.hours;
          locationPayment.textContent = data.payment;
          locationService.textContent = data.service;
          locationDesc1.textContent = data.desc1;
          locationDesc2.textContent = data.desc2;
          locationDesc3.textContent = data.desc3;
        });
      });
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/vending-place.blade.php ENDPATH**/ ?>