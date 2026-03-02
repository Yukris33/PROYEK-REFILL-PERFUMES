@extends('layouts.app')

@section('title', 'Refill Parfum')


@section('content')
<div data-page-css="{{ asset('css/main.css') }}"></div>
<div id="page" class="page">
<div class="refill-page">
<div class="catalog">
  <div class="catalog__grid">

    <!-- 01 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="{{ asset('img/peach bloom 4 (1) (1).png') }}" alt="Product 01">
      </div>
      <div class="pitem__kicker">Prestige</div>
      <div class="pitem__name">SCENTC Prestige Signature Eau De Parfum</div>
      <div class="pitem__price">15ml 30ml 50ml 100ml</div>
      <div class="pitem__brand">SCENTCYCLE PERFUME</div>
    </article>

    <!-- 02 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="{{ asset('img/ocean breeze fix.png') }}" alt="Product 02">
      </div>
      <div class="pitem__kicker">Aquatic Fresh</div>
      <div class="pitem__name">SCENTC Ocean Breeze Aqua Eau De Parfum</div>
      <div class="pitem__price">20ml 30ml 50ml 100ml</div>
      <div class="pitem__brand">SCENTCYCLE PERFUME</div>
    </article>

    <!-- 03 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="{{ asset('img/midnight.png') }}" alt="Product 03">
      </div>
      <div class="pitem__kicker">Woody Oud</div>
      <div class="pitem__name">SCENTC Midnight Oud Intense Eau De Parfum</div>
      <div class="pitem__price">20ml 50ml 100ml</div>
      <div class="pitem__brand">SCENTCYCLE PERFUME</div>
    </article>

    <!-- 04 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="{{ asset('img/citrus.png') }}" alt="Product 04">
      </div>
      <div class="pitem__kicker">Citrus Fresh</div>
      <div class="pitem__name">SCENTC Citrus Aura Fresh Eau De Cologne</div>
      <div class="pitem__price">10ml 30ml 50ml 70ml</div>
      <div class="pitem__brand">SCENTCYCLE PERFUME</div>
    </article>

    <!-- 05 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="{{ asset('img/velvet1.png') }}" alt="Product 05">
      </div>
      <div class="pitem__kicker">Floral Elegant</div>
      <div class="pitem__name">SCENTC Velvet Bloom Eau De Toilette</div>
      <div class="pitem__price">20ml 50ml 70ml</div>
      <div class="pitem__brand">SCENTCYCLE PERFUME</div>
    </article>

    <!-- 06 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/06.png" alt="Product 06" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 06 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 07 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/07.png" alt="Product 07" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 07 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 08 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/08.png" alt="Product 08" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 08 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 09 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/09.png" alt="Product 09" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 09 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 10 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/10.png" alt="Product 10" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 10 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 11 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/11.png" alt="Product 11" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 11 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 12 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/12.png" alt="Product 12" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 12 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 13 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/13.png" alt="Product 13" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 13 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 14 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/14.png" alt="Product 14" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 14 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 15 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/15.png" alt="Product 15" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 15 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 16 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/16.png" alt="Product 16" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 16 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 17 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/17.png" alt="Product 17" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 17 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 18 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/18.png" alt="Product 18" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 18 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 19 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/19.png" alt="Product 19" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 19 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 20 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/20.png" alt="Product 20" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 20 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 21 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/21.png" alt="Product 21" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 21 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 22 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/22.png" alt="Product 22" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 22 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 23 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/23.png" alt="Product 23" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 23 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 24 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/24.png" alt="Product 24" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 24 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 25 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/25.png" alt="Product 25" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 25 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 26 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/26.png" alt="Product 26" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 26 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 27 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/27.png" alt="Product 27" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 27 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 28 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/28.png" alt="Product 28" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 28 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 29 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/29.png" alt="Product 29" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 29 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

    <!-- 30 -->
    <article class="pitem">
      <div class="pitem__img">
        <img src="/uploads/products/30.png" alt="Product 30" onerror="this.style.display='none'">
      </div>
      <div class="pitem__kicker">WOOD</div>
      <div class="pitem__name">HMNS Example Product 30 Eau De Parfum 100 ml</div>
      <div class="pitem__price">Rp 320,000</div>
      <div class="pitem__brand">HMNS Perfume</div>
    </article>

  </div>
</div>
</div>
</div>
@endsection