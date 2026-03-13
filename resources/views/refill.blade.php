@extends('layouts.app')

@section('title', 'Refill Parfum')

@section('content')
<div data-page-css="{{ asset('css/main.css?v=101') }}"></div>
  <div class="refill-page">
    <div class="catalog">
      <div class="catalog__grid">

        <!-- 01 -->
<article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/peach bloom 4 (1) (1).png') }}" alt="SCENTC Prestige Signature Eau De Parfum">

    <div class="pitem__overlay">
      <a href="{{ route('preview.prestige') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">PRESTIGE</div>
  <div class="pitem__name">SCENTC Prestige Signature Eau De Parfum</div>
  <div class="pitem__price">15ml 30ml 50ml 100ml</div>
  <div class="pitem__brand">Luxurious. Warm. Timeless.</div>
</article>

        <!-- 02 -->
<article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/ocean breeze fix.png') }}" alt="SCENTC Ocean Breeze Aqua Eau De Parfum">

    <div class="pitem__overlay">
      <a href="{{ route('preview.ocean') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">AQUATIC FRESH</div>
  <div class="pitem__name">SCENTC Ocean Breeze Aqua Eau De Parfum</div>
  <div class="pitem__price">20ml 30ml 50ml 100ml</div>
  <div class="pitem__brand">Fresh. Clean. Invigorating.</div>
</article>


        <!-- 02 -->
      <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/midnight.png') }}" alt="SCENTC Midnight Oud Intense Eau De Parfum">

    <div class="pitem__overlay">
      <a href="{{ route('preview.midnight') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">WOODY OUD</div>
  <div class="pitem__name">SCENTC Midnight Oud Intense Eau De Parfum</div>
  <div class="pitem__price">20ml 50ml 100ml</div>
  <div class="pitem__brand">Dark. Bold. Intense.</div>
</article>

        <!-- 04 -->
        <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/citrus.png') }}" alt="SCENTC Citrus Aura Fresh Eau De Cologne">

    <div class="pitem__overlay">
      <a href="{{ route('preview.citrus') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">CITRUS FRESH</div>
  <div class="pitem__name">SCENTC Citrus Aura Fresh Eau De Cologne</div>
  <div class="pitem__price">10ml 30ml 50ml 70ml</div>
  <div class="pitem__brand">Bright. Crisp. Energizing.</div>
</article>

        <!-- 05 -->
        <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/velvet1.png') }}" alt="SCENTC Velvet Bloom Eau De Toilette">

    <div class="pitem__overlay">
      <a href="{{ route('preview.velvet') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">FLORAL ELEGANT</div>
  <div class="pitem__name">SCENTC Velvet Bloom Eau De Toilette</div>
  <div class="pitem__price">20ml 50ml 70ml</div>
  <div class="pitem__brand">Soft. Elegant. Timeless.</div>
</article>

        <!-- 06 -->
        <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/vanila.png') }}" alt="SCENTC Vanilla Suede Eau De Parfum">

    <div class="pitem__overlay">
      <a href="{{ route('preview.vanilla') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">GOURMAND WARM</div>
  <div class="pitem__name">SCENTC Vanilla Suede Eau De Parfum</div>
  <div class="pitem__price">10ml 30ml 50ml 70ml</div>
  <div class="pitem__brand">Warm. Creamy. Addictive.</div>
</article>

        <!-- 07 -->
      <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/silver2.png') }}" alt="SCENTC Silver Mist Eau De Toilette">

    <div class="pitem__overlay">
      <a href="{{ route('preview.silver') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">WOODY FRESH</div>
  <div class="pitem__name">SCENTC Silver Mist Eau De Toilette</div>
  <div class="pitem__price">10ml 20ml 25ml 30ml</div>
  <div class="pitem__brand">Cool. Clean. Modern.</div>
</article>
        <!-- 08 -->
        <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/blue.png') }}" alt="SCENTC Blue Neroli Eau De Toilette">

    <div class="pitem__overlay">
      <a href="{{ route('preview.blue') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">CITRUS WOOD</div>
  <div class="pitem__name">SCENTC Blue Neroli Eau De Toilette</div>
  <div class="pitem__price">20ml 25ml 30ml</div>
  <div class="pitem__brand">Fresh. Bright. Airy.</div>
</article>

        <!-- 09 -->
        <article class="pitem">
  <div class="pitem__img">
    <img src="{{ asset('img/green.jpeg') }}" alt="SCENTC Emerald Cedar Eau De Parfum">

    <div class="pitem__overlay">
      <a href="{{ route('preview.emerald') }}" class="pitem__btn">
        Lihat Selengkapnya
      </a>
    </div>
  </div>

  <div class="pitem__kicker">WOOD INTENSE</div>
  <div class="pitem__name">SCENTC Emerald Cedar Eau De Parfum</div>
  <div class="pitem__price">10ml 20ml 30ml</div>
  <div class="pitem__brand">Deep. Smooth. Sophisticated.</div>
</article>
      </div>
    </div>


<section class="refill-guide-wide">
  <div class="refill-guide-wide__container">

    <div class="refill-guide-wide__intro">
      <div class="refill-guide-wide__label">REFILL GUIDE</div>
      <h2 class="refill-guide-wide__title">Cara Refill di Scentcycle</h2>

      <p class="refill-guide-wide__desc">
        Nikmati pengalaman refill parfum yang lebih praktis, higienis, dan terarah.
        Setiap tahap dirancang agar proses pengisian berjalan aman, presisi, dan tetap nyaman
        untuk setiap pelanggan, mulai dari memilih scent, menyiapkan botol yang sesuai,
        memosisikan botol pada mesin, memantau proses pengisian secara real-time,
        hingga botol kembali siap digunakan atau dibawa pulang dalam kondisi optimal.
      </p>
    </div>

    <div class="refill-guide-wide__steps">
      <article class="refill-guide-card">
        <div class="refill-guide-card__number">01</div>
        <div class="refill-guide-card__content">
          <h3>Menentukan Scent</h3>
          <p>
            Pilih scent favorit Anda melalui website Scentcycle dengan memastikan varian aroma,
            ukuran isi, dan detail pesanan sudah benar. Tahap ini penting agar proses refill
            selanjutnya berjalan lebih cepat, tepat, dan sesuai dengan preferensi yang Anda inginkan.
          </p>
        </div>
      </article>

      <article class="refill-guide-card">
        <div class="refill-guide-card__number">02</div>
        <div class="refill-guide-card__content">
          <h3>Siapkan Botol</h3>
          <p>
            Gunakan botol yang bersih, kering, dan aman untuk proses pengisian ulang. Pastikan juga
            ukuran botol compatible dengan kapasitas refill yang dipilih agar parfum dapat terisi
            dengan baik tanpa mengganggu kualitas, kebersihan, maupun kenyamanan saat proses berlangsung.
          </p>
        </div>
      </article>

      <article class="refill-guide-card">
        <div class="refill-guide-card__number">03</div>
        <div class="refill-guide-card__content">
          <h3>Posisikan Botol</h3>
          <p>
            Letakkan botol pada area pengisian dengan posisi yang stabil dan presisi. Setelah botol
            terbaca oleh sensor, sistem akan mendeteksi kesiapan pengisian sehingga proses refill
            dapat dimulai secara lebih akurat, aman, dan minim risiko kesalahan posisi.
          </p>
        </div>
      </article>

      <article class="refill-guide-card">
        <div class="refill-guide-card__number">04</div>
        <div class="refill-guide-card__content">
          <h3>Lihat Progress</h3>
          <p>
            Pantau jalannya proses refill melalui indikator LCD yang menampilkan perkembangan volume
            isi secara real-time. Dengan begitu, Anda dapat melihat bahwa pengisian berlangsung sesuai
            pesanan dan memastikan setiap tahap berjalan dengan jelas, transparan, dan terukur.
          </p>
        </div>
      </article>

      <article class="refill-guide-card refill-guide-card--final">
        <div class="refill-guide-card__number">05</div>
        <div class="refill-guide-card__content">
          <h3>Ambil Botol</h3>
          <p>
            Setelah pengisian selesai, ambil kembali botol Anda dengan hati-hati dan periksa hasilnya
            secara singkat. Pastikan volume refill telah sesuai dengan pesanan sehingga parfum siap
            digunakan kembali, disimpan, atau dibawa pulang dalam kondisi yang rapi dan optimal.
          </p>
        </div>
      </article>
    </div>

  </div>
</section>
</div>
</div>
@endsection