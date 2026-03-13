

<?php $__env->startSection('title', 'Vending Mechine & Place - SCENTCYCLE'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/vending-place.css')); ?>" data-page-css="<?php echo e(asset('css/vending-place.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="vp-page">
  <div class="vp-container">
    <div class="vp-sheet">

      
      <section class="vp-row vp-row--hero">
        <div class="vp-media">
          <img src="<?php echo e(asset('img/depan.png')); ?>" alt="Mesin SCENTCYCLE tampak depan" class="vp-img">
        </div>

        <div class="vp-text">
          <p class="vp-label">VENDING MECHINE & PLACE</p>
          <h1 class="vp-title">SCENTCYCLE Smart Refill & Bottle Return Station</h1>

          <div class="vp-copy">
            <p>SCENTCYCLE merupakan mesin refill parfum modern yang dirancang untuk menghadirkan pengalaman isi ulang parfum yang praktis, higienis, efisien, serta tetap memiliki nilai visual premium. Mesin ini tidak hanya berfungsi sebagai alat dispensing parfum, tetapi juga sebagai sistem interaktif yang menghubungkan pengguna, produk, dan konsep keberlanjutan melalui proses refill serta pengembalian botol bekas.</p>

            <p>Pada tampilan depan, seluruh elemen interaksi utama disusun secara terstruktur agar mudah dipahami pengguna. Area scan, petunjuk penggunaan, indikator volume, area refill, test spray, serta kompartemen return bottle ditempatkan dalam satu panel yang jelas sehingga alur penggunaan terasa lebih intuitif. Sistem ini didukung oleh mikrokontroler ESP32 yang berfungsi sebagai pusat kontrol untuk membaca berbagai sensor dan mengatur proses refill parfum secara otomatis.</p>

            <p>Dalam konteks penempatan, mesin ini dirancang untuk ditempatkan di area kampus sebagai lingkungan dengan aktivitas pengguna yang tinggi serta terbiasa dengan interaksi digital. Kehadirannya tidak hanya berfungsi sebagai fasilitas refill parfum, tetapi juga sebagai media interaksi antara teknologi, produk, dan pengguna dalam satu sistem layanan yang praktis, modern, dan berkelanjutan.</p>
          </div>
        </div>
      </section>

      
      <section class="vp-row">
        <div class="vp-media">
          <img src="<?php echo e(asset('img/pbelakang.png')); ?>" alt="Bagian belakang mesin SCENTCYCLE" class="vp-img">
        </div>

        <div class="vp-text">
          <p class="vp-label">BACK VIEW</p>
          <h2 class="vp-subtitle">Panel Konektivitas dan Dukungan Sistem untuk Mesin Pintar</h2>

          <div class="vp-copy">
            <p>Bagian belakang mesin menunjukkan bahwa SCENTCYCLE dirancang sebagai perangkat yang mendukung operasional berbasis sistem digital dan IoT. Panel ini menyediakan berbagai konektivitas seperti power supply, ethernet, USB service, antena WiFi, SIM slot, serta tombol reset yang memungkinkan mesin terhubung dengan sistem monitoring dan pengelolaan data.</p>

            <p>Mikrokontroler ESP32 yang berada di dalam mesin berperan sebagai pusat pengolahan data yang terhubung dengan berbagai sensor dan aktuator. Melalui konektivitas internet, sistem dapat mengirimkan informasi operasional seperti status mesin, aktivitas refill, serta performa perangkat ke sistem website untuk kebutuhan monitoring dan pengelolaan layanan.</p>

            <p>Dari sisi teknis, panel belakang juga mempermudah proses pengecekan, perawatan, serta troubleshooting oleh teknisi tanpa harus mengganggu area interaksi utama pengguna di bagian depan. Dengan demikian, mesin dapat tetap beroperasi secara stabil, aman, dan efisien dalam jangka waktu penggunaan yang panjang.</p>
          </div>
        </div>
      </section>

      
      <section class="vp-duo">
        <article class="vp-panel">
          <div class="vp-panel__media">
            <img src="<?php echo e(asset('img/pkiri.png')); ?>" alt="Sisi kiri mesin SCENTCYCLE" class="vp-img">
          </div>

          <div class="vp-panel__text">
            <p class="vp-label">LEFT SIDE</p>
            <h2 class="vp-subtitle">Ruang Penyimpanan Fragrance Storage untuk Operasional Refill</h2>

            <div class="vp-copy">
              <p>Pada sisi kiri mesin terdapat ruang penyimpanan yang berfungsi sebagai kompartemen servis untuk mendukung kebutuhan operasional refill. Area ini digunakan untuk menyimpan tangki parfum dari berbagai varian fragrance yang akan disalurkan ke sistem dispenser pada bagian depan mesin.</p>

              <p>Setiap tangki parfum dilengkapi dengan sensor level cairan yang terhubung dengan mikrokontroler ESP32 untuk memantau sisa stok parfum secara otomatis. Data ketersediaan parfum ini dapat dikirimkan ke sistem website sehingga operator dapat mengetahui kondisi stok tanpa perlu membuka mesin secara langsung.</p>

              <p>Keberadaan ruang penyimpanan ini juga mempermudah proses penggantian atau pengisian ulang tangki parfum oleh operator. Dengan penempatan pada sisi samping mesin, area servis dapat diakses secara praktis tanpa mengganggu area interaksi utama yang digunakan oleh pengguna di bagian depan mesin.</p>
            </div>
          </div>
        </article>

        <article class="vp-panel">
          <div class="vp-panel__media">
            <img src="<?php echo e(asset('img/pkanan.png')); ?>" alt="Sisi kanan mesin SCENTCYCLE" class="vp-img">
          </div>

          <div class="vp-panel__text">
            <p class="vp-label">RIGHT SIDE</p>
            <h2 class="vp-subtitle">Pemisahan Area Refill dan Unused Bottle untuk Alur yang Lebih Jelas</h2>

            <div class="vp-copy">
              <p>Pada sisi kanan mesin, kompartemen dibagi menjadi dua bagian utama yang mewakili dua fungsi berbeda, yaitu area refill support dan area pengumpulan botol bekas. Pemisahan ini membantu sistem internal bekerja lebih terstruktur sekaligus memperjelas fungsi mesin bagi pengguna.</p>

              <p>Area refill terhubung dengan sistem dispenser yang dikontrol oleh mikrokontroler ESP32. Ketika pengguna melakukan proses refill, sistem akan mengaktifkan pompa dispenser dan memantau volume parfum yang dikeluarkan melalui sistem pengukuran volume sehingga proses isi ulang dapat berjalan secara presisi dan terkontrol.</p>

              <p>Sementara itu, kompartemen unused bottle digunakan untuk mengumpulkan botol bekas dari pengguna. Area ini dilengkapi dengan sensor infrared yang berfungsi mendeteksi setiap botol yang dimasukkan ke dalam mesin. Data jumlah botol kemudian diproses oleh ESP32 dan dapat digunakan sebagai bagian dari sistem monitoring serta pengelolaan botol return.</p>
            </div>
          </div>
        </article>
      </section>

      
<section class="vp-row vp-row--last">
  <div class="vp-text">
    <p class="vp-label">FRONT PANEL</p>
    <h2 class="vp-subtitle">Panel Interaksi Utama untuk Pengalaman Refill yang Intuitif</h2>

    <div class="vp-copy">
      <p>
        Panel depan mesin merupakan pusat interaksi utama yang menghubungkan pengguna
        dengan seluruh layanan SCENTCYCLE. Melalui panel ini, pengguna dapat memulai
        proses dengan memindai QR code, memverifikasi transaksi melalui barcode scanner,
        membaca instruksi penggunaan, mencoba aroma melalui fitur test spray, hingga
        melakukan proses refill parfum secara lebih mudah dan terarah.
      </p>

      <p>
        Selain untuk layanan refill, panel ini juga mendukung proses pembelian botol.
        Setelah transaksi botol berhasil divalidasi, sistem akan memproses pengeluaran
        botol secara otomatis dari kompartemen penyimpanan di bagian bawah mesin.
        Botol kemudian didorong keluar menuju slot pengambilan di sisi kanan menggunakan
        mekanisme motorik yang dikendalikan oleh ESP32. Proses ini memerlukan waktu sekitar
        1–2 menit setelah validasi selesai, hingga botol siap diambil oleh pengguna.
      </p>

      <p>
        Seluruh interaksi tersebut dikontrol oleh mikrokontroler ESP32 yang menerima input
        dari berbagai sensor, seperti sensor posisi botol, sensor volume refill, dan sensor
        pendeteksi keluaran botol. Sistem kemudian mengatur kerja aktuator seperti pompa
        parfum, indikator LED, serta motor pendorong botol untuk memastikan setiap proses
        berjalan dengan aman, presisi, dan terkoordinasi.
      </p>
    </div>
  </div>

  <div class="vp-media">
    <img src="<?php echo e(asset('img/depanbener.png')); ?>" alt="Panel depan fitur mesin SCENTCYCLE" class="vp-img">
  </div>
</section>

      
      <section class="vp-row">
        <div class="vp-media vp-media--map">
          <div class="vp-map-frame">
            <iframe
              src="https://www.google.com/maps?q=Universitas%20Multimedia%20Nusantara&z=17&output=embed"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>

        <div class="vp-text">
          <p class="vp-label">LOCATION</p>
          <h2 class="vp-subtitle">Lokasi Mesin SCENTCYCLE</h2>

          <div class="vp-copy">
            <p>Mesin SCENTCYCLE ditempatkan di area Kampus Universitas Multimedia Nusantara (UMN) sebagai bagian dari simulasi penempatan mesin pada lingkungan publik yang memiliki aktivitas pengguna tinggi. Lokasi ini dipilih karena mahasiswa dan komunitas kampus umumnya terbiasa dengan teknologi digital serta terbuka terhadap konsep layanan inovatif.</p>

            <p>Melalui sistem berbasis IoT dan mikrokontroler ESP32, mesin dapat melakukan monitoring operasional seperti jumlah refill parfum, sisa stok fragrance, serta jumlah botol bekas yang dikembalikan oleh pengguna. Informasi tersebut dapat diakses melalui sistem website sehingga pengelolaan mesin dapat dilakukan secara lebih efisien.</p>

            <p>Selain berfungsi sebagai perangkat refill parfum, mesin ini juga berperan sebagai media edukasi mengenai konsep refill dan pengelolaan botol bekas sebagai bagian dari gaya hidup yang lebih berkelanjutan di lingkungan kampus.</p>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/vending-place.blade.php ENDPATH**/ ?>