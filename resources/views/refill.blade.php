@extends('layouts.app')

@section('title', 'Refill Parfum')

@section('content')
<div data-page-css="{{ asset('css/main.css?v=102') }}"></div>
  <div class="refill-page">
    <div class="catalog">
      <div class="catalog__grid">

      

        <!-- 01 -->
<article class="pitem"
  data-category="edp"
  data-sizes="15ml|30ml|50ml|100ml"
  data-aromas="warm">
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
<article class="pitem"
  data-category="edp"
  data-sizes="20ml|30ml|50ml|100ml"
  data-aromas="fresh|aquatic">
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
      <article class="pitem"
  data-category="edp"
  data-sizes="20ml|50ml|100ml"
  data-aromas="woody|warm">
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
        <article class="pitem"
  data-category="cologne"
  data-sizes="10ml|30ml|50ml|70ml"
  data-aromas="fresh|citrus">
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
        <article class="pitem"
  data-category="edt"
  data-sizes="20ml|50ml|70ml"
  data-aromas="floral">
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
        <article class="pitem"
  data-category="edp"
  data-sizes="10ml|30ml|50ml|70ml"
  data-aromas="warm|gourmand">
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
      <article class="pitem"
  data-category="edt"
  data-sizes="10ml|20ml|25ml|30ml"
  data-aromas="fresh|woody">
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
        <article class="pitem"
  data-category="edt"
  data-sizes="20ml|25ml|30ml"
  data-aromas="fresh|citrus">
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
        <article class="pitem"
  data-category="edp"
  data-sizes="10ml|20ml|30ml"
  data-aromas="woody">
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
    <div class="catalog-filter-empty" id="catalogFilterEmpty" hidden>
  <i class="bi bi-search"></i>
  <strong>Produk tidak ditemukan.</strong>
  <span>Coba ubah kategori, ukuran, atau karakter aroma.</span>
</div>


<section class="refill-guide-wide">
  <div class="refill-guide-wide__container">

    <div class="refill-guide-wide__intro">
      <div class="refill-guide-wide__label">REFILL GUIDE</div>
      <h2 class="refill-guide-wide__title">Cara Refill di Scentcycle</h2>

      <p class="refill-guide-wide__desc">
        Ikuti proses refill parfum yang lebih praktis, higienis, dan presisi melalui
        smart refill station Scentcycle. Dari memilih scent, menyiapkan botol,
        memindai pesanan, hingga botol siap digunakan kembali.
      </p>

      <div class="refill-guide-wide__chips">
        <span>Praktis</span>
        <span>Higienis</span>
        <span>Presisi</span>
        <span>Eco Friendly</span>
      </div>
    </div>

    <div class="refill-guide-wide__layout">

      <div class="refill-guide-wide__steps" id="refillGuideSteps">

        <button type="button" class="refill-guide-card is-active"
          data-step="01"
      
          data-stage="1"
          data-title="Menentukan Scent"
          data-desc="Pilih scent favorit melalui website Scentcycle. Pastikan varian aroma, ukuran isi, cabang mesin, dan detail pesanan sudah sesuai sebelum melanjutkan proses refill."
          data-screen="SELECT SCENT"
          data-tags="Pilih aroma,Ukuran refill,Cabang mesin">
          <div class="refill-guide-card__number">01</div>
          <div class="refill-guide-card__content">
            <h3>Menentukan Scent</h3>
            <p>Pilih aroma, ukuran refill, dan cabang mesin melalui website.</p>
          </div>
        </button>

        <button type="button" class="refill-guide-card"
          data-step="02"
          data-percent="0%"
          data-stage="2"
          data-title="Siapkan Botol"
          data-desc="Gunakan botol yang bersih, kering, dan sesuai dengan kapasitas refill yang dipilih. Botol yang siap membantu proses pengisian berjalan lebih aman dan optimal."
          data-screen="READY BOTTLE"
          data-tags="Botol bersih,Botol kering,Ukuran sesuai">
          <div class="refill-guide-card__number">02</div>
          <div class="refill-guide-card__content">
            <h3>Siapkan Botol</h3>
            <p>Pastikan botol bersih, kering, dan sesuai ukuran pesanan.</p>
          </div>
        </button>

        <button type="button" class="refill-guide-card"
          data-step="03"
          data-percent="10%"
            data-stage="3"
          data-title="Posisikan Botol"
          data-desc="Letakkan botol pada area pengisian mesin dengan posisi stabil. Sensor akan membantu mendeteksi kesiapan botol sebelum proses refill dimulai."
          data-screen="PLACE BOTTLE"
          data-tags="Sensor botol,Posisi stabil,Minim tumpah">
          <div class="refill-guide-card__number">03</div>
          <div class="refill-guide-card__content">
            <h3>Posisikan Botol</h3>
            <p>Letakkan botol pada refill station sampai posisi terbaca sensor.</p>
          </div>
        </button>

        <button type="button" class="refill-guide-card"
          data-step="04"
          data-percent="72%"
          data-stage="4"
          data-title="Lihat Progress"
          data-desc="Pantau jalannya proses refill melalui indikator mesin. Sistem menampilkan progress pengisian secara real-time agar proses lebih transparan dan terukur."
          data-screen="REFILLING..."
          data-tags="Real-time,LCD progress,Volume presisi">
          <div class="refill-guide-card__number">04</div>
          <div class="refill-guide-card__content">
            <h3>Lihat Progress</h3>
            <p>Pantau proses refill melalui indikator progress pada mesin.</p>
          </div>
        </button>

        <button type="button" class="refill-guide-card refill-guide-card--final"
          data-step="05"
          data-percent="100%"
          data-stage="5"
          data-title="Ambil Botol"
          data-desc="Setelah pengisian selesai, ambil kembali botol dengan hati-hati. Parfum siap digunakan kembali, disimpan, atau dibawa pulang dalam kondisi optimal."
          data-screen="DONE"
          data-tags="Refill selesai,Siap digunakan,Ramah lingkungan">
          <div class="refill-guide-card__number">05</div>
          <div class="refill-guide-card__content">
            <h3>Ambil Botol</h3>
            <p>Ambil botol dan parfum siap digunakan kembali.</p>
          </div>
        </button>

      </div>

      <aside class="refill-guide-preview" id="refillGuidePreview">
  <div class="refill-guide-preview__top">
    <span id="refillPreviewStep">STEP 01</span>
    <span class="refill-guide-preview__status">SMART REFILL</span>
  </div>

  <div class="refill-guide-preview__visual stage-1" id="refillPreviewVisual">
    <div class="refill-machine">
      <div class="refill-machine__screen">
  <small>SCENTCYCLE</small>
  <strong id="refillPreviewScreen">SELECT SCENT</strong>

  <div class="refill-machine__screen-meta">
  <span class="refill-machine__screen-label">REFILL LEVEL</span>
  <span class="refill-machine__progress is-empty" id="refillPreviewPercent"></span>
</div>
</div>
      <div class="refill-machine__order-light"></div>
      <div class="refill-machine__nozzle-wrap">
  <div class="refill-machine__nozzle"></div>
  <div class="refill-machine__sensor-dot"></div>
  <div class="refill-machine__sensor-beam"></div>
</div>

      <div class="refill-machine__guide-text">PUT YOUR BOTTLE HERE</div>

      <div class="refill-machine__refill-area">
        <div class="refill-machine__bottle">
          <span class="refill-machine__liquid"></span>
        </div>

        <div class="refill-machine__flow"></div>
        <div class="refill-machine__done">DONE</div>
      </div>

      <div class="refill-machine__base"></div>
    </div>
  </div>

  <div class="refill-guide-preview__copy">
    <h3 id="refillPreviewTitle">Menentukan Scent</h3>
    <p id="refillPreviewDesc">
      Pilih scent favorit melalui website Scentcycle. Pastikan varian aroma, ukuran isi,
      cabang mesin, dan detail pesanan sudah sesuai sebelum melanjutkan proses refill.
    </p>
  </div>

  <div class="refill-guide-preview__tags" id="refillPreviewTags">
    <span>Pilih aroma</span>
    <span>Ukuran refill</span>
    <span>Cabang mesin</span>
  </div>

  <div class="refill-guide-preview__note">
    <strong>Tips:</strong> pastikan ukuran refill sesuai dengan kapasitas botol agar proses berjalan optimal.
  </div>
</aside>

    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const cards = document.querySelectorAll('.refill-guide-card');
  const preview = document.getElementById('refillGuidePreview');
  const previewVisual = document.getElementById('refillPreviewVisual');

  const stepText = document.getElementById('refillPreviewStep');
  const screenText = document.getElementById('refillPreviewScreen');
  const titleText = document.getElementById('refillPreviewTitle');
  const descText = document.getElementById('refillPreviewDesc');
  const tagsWrap = document.getElementById('refillPreviewTags');
  const percentText = document.getElementById('refillPreviewPercent');

  if (!cards.length || !preview || !previewVisual) return;

  cards.forEach(function(card) {
    card.addEventListener('click', function() {
      cards.forEach(function(item) {
        item.classList.remove('is-active');
      });

      card.classList.add('is-active');

      const step = card.dataset.step;
      const stage = card.dataset.stage;
      const title = card.dataset.title;
      const desc = card.dataset.desc;
      const screen = card.dataset.screen;
      const tags = card.dataset.tags ? card.dataset.tags.split(',') : [];
      const percent = card.dataset.percent || '0%';

      preview.classList.remove('is-changing');
      void preview.offsetWidth;
      preview.classList.add('is-changing');

      previewVisual.classList.remove('stage-1', 'stage-2', 'stage-3', 'stage-4', 'stage-5');
      previewVisual.classList.add('stage-' + stage);

      stepText.textContent = 'STEP ' + step;
      screenText.textContent = screen;
      titleText.textContent = title;
      descText.textContent = desc;
      if (percentText) {
  if (stage === '1') {
    percentText.textContent = '';
    percentText.classList.add('is-empty');
  } else {
    percentText.textContent = percent;
    percentText.classList.remove('is-empty');
  }
}

      tagsWrap.innerHTML = '';

      tags.forEach(function(tag) {
        const span = document.createElement('span');
        span.textContent = tag.trim();
        tagsWrap.appendChild(span);
      });
    });
  });
});
</script>
@endsection