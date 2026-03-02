@extends('layouts.app')

@section('title', 'SCENTCYCLE')

@section('content')
<div data-page-css="{{ asset('css/home.css') }}"></div>

<div id="page" class="page">
  <div class="home-page">
    <div class="home-rail">

      {{-- HERO --}}
      <section class="sc-hero">
        <div class="sc-hero__top">
          <p class="sc-eyebrow">REFILL • REUSE • REBUILD</p>
          <span class="sc-tag">Circular Fragrance</span>
        </div>

        <h1 class="sc-title">SCENTCYCLE</h1>

        <p class="sc-desc">
        ScentCycle adalah konsep parfum sirkular yang dirancang untuk menghadirkan pengalaman wewangian yang lebih rapi, elegan, dan bertanggung jawab. 
        Kami percaya bahwa kualitas parfum tidak hanya dinilai dari aromanya, tetapi juga dari cara produk itu digunakan secara konsisten, disimpan dengan baik, 
        dan dikelola setelah habis dipakai. Karena itu, kami menghadirkan layanan refill yang praktis serta opsi rebuilt bottle, 
        yaitu botol yang telah direstorasi dan diseleksi dengan standar kualitas tertentu agar tetap terlihat premium dan nyaman digunakan. 
        Dengan pendekatan ini, kamu bisa menikmati aroma favorit secara berkelanjutan, menjaga estetika koleksi parfum, sekaligus membantu menekan jejak limbah 
        kemasan dari pemakaian botol sekali pakai.
        </p>

        <p class="sc-desc sc-desc--sub">
          Intinya: satu aroma bisa dipakai berulang, satu botol bisa punya “hidup kedua”.
          Kamu tetap tampil percaya diri, dan di saat yang sama ikut membantu mengurangi sampah kemasan.
        </p>

        <div class="sc-cta">
          <a href="{{ route('products.refill') }}" class="sc-btn sc-btn--primary">Shop Refill</a>
          <a href="{{ route('products.refill') }}" class="sc-btn sc-btn--ghost">Explore Brand</a>
        </div>
      </section>

      {{-- WHY --}}
<section class="sc-why">
  <div class="sc-head">
    <h2 class="sc-h2">WHY SCENTCYCLE?</h2>
    <p class="sc-lead">
      Karena parfum yang bagus harusnya nggak berhenti di “wangi”.
      Harus nyaman dipakai, rapi disimpan, dan yang paling penting: nggak nambah beban sampah kemasan.
    </p>
  </div>

  <div class="why-rows">

    {{-- 1: gambar kiri - teks kanan --}}
    <article class="why-row">
      <div class="why-media">
        <img src="{{ asset('img/ref.png') }}" alt="Refill tanpa ribet" loading="lazy">
      </div>
      <div class="why-body">
        <h3 class="why-title">Refill Tanpa Ribet</h3>
        <p class="why-text">
          Pilih aroma dan ukuran, lalu isi ulang dengan proses yang rapi. Kamu tetap dapet experience premium,
          tapi tanpa harus “mulai dari botol baru” setiap kali habis.
        </p>
        <ul class="why-points">
          <li>Lebih praktis buat yang rutin pakai parfum</li>
          <li>Tampil tetap clean: botolnya tetap rapi & proper</li>
          <li>Ngurangin kebutuhan kemasan baru berulang-ulang</li>
        </ul>
      </div>
    </article>

    {{-- 2: gambar kanan - teks kiri --}}
    <article class="why-row why-row--reverse">
      <div class="why-media">
        <img src="{{ asset('img/don.png') }}" alt="Rebuilt bottle" loading="lazy">
      </div>
      <div class="why-body">
        <h3 class="why-title">Rebuilt Bottle</h3>
        <p class="why-text">
          Botol yang direstorasi dan diseleksi biar layak dipakai lagi. Jadi bukan sekadar “reuse”,
          tapi tetap terasa elegan dan pantas buat meja rias.
        </p>
        <ul class="why-points">
          <li>Botol punya “hidup kedua” tanpa ngorbanin tampilan</li>
          <li>Lebih mindful: pakai ulang yang masih layak</li>
          <li>Lebih hemat material dibanding produksi botol baru</li>
        </ul>
      </div>
    </article>

    {{-- 3: gambar kiri - teks kanan --}}
    <article class="why-row">
      <div class="why-media">
        <img src="{{ asset('img/scan.png') }}" alt="Return & appreciation" loading="lazy">
      </div>
      <div class="why-body">
        <h3 class="why-title">Return & Appreciation</h3>
        <p class="why-text">
          Setelah selesai, kamu bisa return botol lewat program kami dan dapet apresiasi untuk pembelian berikutnya.
          Ini bikin “sirkular” jadi kebiasaan, bukan wacana.
        </p>
        <ul class="why-points">
          <li>Return jadi gampang dan jelas langkahnya</li>
          <li>Ada apresiasi biar kamu makin semangat</li>
          <li>Ngurangin sampah kemasan yang berakhir di TPA/lingkungan</li>
        </ul>
      </div>
    </article>

  </div>

  <div class="sc-frame">
    <div class="frame-left">
      <h3 class="frame-title">How it works</h3>
      <p class="frame-sub">Dibuat supaya gampang diikutin—nggak bikin kamu mikir panjang.</p>
    </div>

    <div class="steps">
      <div class="step"><span class="step-num">01</span> Pilih aroma</div>
      <div class="step"><span class="step-num">02</span> Refill / pilih rebuilt bottle</div>
      <div class="step"><span class="step-num">03</span> Return saat sudah selesai</div>
    </div>
  </div>
</section>

      {{-- SDG --}}
<section class="sc-sdg">
  <div class="sc-head">
    <h2 class="sc-h2">We Support the SDGs</h2>
    <p class="sc-lead">
      ScentCycle nyambung langsung ke SDG 12 (Responsible Consumption & Production) dan SDG 13 (Climate Action).
      Kenapa ini penting di Indonesia? Karena problem sampah & emisi itu nyata—dan sebagian besar datang dari pola konsumsi harian.
    </p>
  </div>

  <div class="sdg-story">
    <p>
      Di Indonesia, sampah nasional yang tercatat mencapai puluhan juta ton per tahun—dan masih ada porsi besar yang belum terkelola baik. Misalnya, data yang dirangkum dari SIPSN (KLHK) dan diberitakan BRIN menunjukkan angka timbunan sampah nasional yang besar, dengan jutaan ton masih “tidak tertangani” (mismanaged). :contentReference[oaicite:0]{index=0}
    </p>
    <p>
      Khusus plastik, tantangannya makin kerasa karena plastik ringan, gampang bocor ke lingkungan,
      lalu ikut aliran sungai sampai ke laut. Ada laporan yang menyorot bagaimana praktik pengelolaan sampah lokal
      berkontribusi pada pencemaran plastik di sungai & pesisir Indonesia. :contentReference[oaicite:1]{index=1}
      Beberapa kajian juga sering mengutip estimasi bahwa jutaan ton plastik “tidak terkelola” tiap tahun,
      dan sebagian berakhir di laut. :contentReference[oaicite:2]{index=2}
    </p>
    <p>
      Di sisi iklim (SDG 13), pertumbuhan ekonomi dan aktivitas berbasis energi & lahan mendorong emisi naik.
      Indonesia juga rentan terhadap dampak perubahan iklim (banjir, cuaca makin nggak bisa ditebak, gangguan produksi pangan).
      Laporan World Bank menekankan kebutuhan transisi menuju pertumbuhan yang seimbang antara pembangunan dan lingkungan. :contentReference[oaicite:3]{index=3}
    </p>
    <p>
      Karena itu, konsep “refill & reuse” itu bukan gaya-gayaan. Ini cara sederhana untuk mengurangi kebutuhan kemasan baru,
      menekan sampah yang harus ditangani, dan pelan-pelan mengubah kebiasaan konsumsi jadi lebih bertanggung jawab.
    </p>
  </div>

  <div class="sdg-grid">
    <div class="sdg-card">
      <img src="{{ asset('img/sdg12.png') }}" alt="SDG 12" />
    </div>
    <div class="sdg-card">
      <img src="{{ asset('img/sdg13.png') }}" alt="SDG 13" />
    </div>
  </div>

  <p class="sc-sdg__hint">
    Intinya: satu aroma bisa dipakai berulang, satu botol bisa punya “hidup kedua”.
    Dampaknya kecil kalau sendirian, tapi jadi besar kalau jadi kebiasaan.
  </p>
</section>

    </div>
  </div>
</div>
@endsection