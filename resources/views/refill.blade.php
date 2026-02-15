@extends('layouts.app')

@section('title', 'Refill Parfum')

@section('content')
  <div class="breadcrumb">
    <a href="/">Home</a> <span>›</span>
    <a href="#">PARFUM</a> <span>›</span>
    <span>Refill Parfum</span>
  </div>

  <div class="pillbar">
    <a class="pill is-active" href="#">All PARFUM</a>
    <a class="pill" href="#">PARFUM WANITA</a>
    <a class="pill" href="#">PARFUM PRIA</a>
    <a class="pill" href="#">PARFUM UNISEX</a>
    <a class="pill" href="{{ route('products.refill') }}">Refill Parfum</a>
  </div>

  <div class="page">
    {{-- SIDEBAR --}}
    <aside class="sidebar">
      <h3 class="sidebar__title">REFILL PARFUM</h3>

      <form method="GET" action="{{ route('products.refill') }}" class="filters">
        <details open class="filter">
          <summary>Harga</summary>
          <div class="filter__body">
            <input name="price_min" class="input" type="number" placeholder="Min" value="{{ request('price_min') }}">
            <input name="price_max" class="input" type="number" placeholder="Max" value="{{ request('price_max') }}">
          </div>
        </details>

        <button class="btn" type="submit">Terapkan</button>
      </form>
    </aside>

    {{-- CONTENT --}}
    <section class="content">
      <div class="content__top">
        <div class="count">({{ $products->total() }} produk)</div>

        <form method="GET" action="{{ route('products.refill') }}">
          {{-- keep query lain --}}
          @foreach(request()->except('sort','page') as $k=>$v)
            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
          @endforeach

          <select name="sort" class="select" onchange="this.form.submit()">
            <option value="popular"   @selected($sort==='popular')>Sortir: Populer</option>
            <option value="newest"    @selected($sort==='newest')>Terbaru</option>
            <option value="price_asc" @selected($sort==='price_asc')>Harga: Rendah → Tinggi</option>
            <option value="price_desc"@selected($sort==='price_desc')>Harga: Tinggi → Rendah</option>
          </select>
        </form>
      </div>

      <div class="grid">
        @foreach($products as $p)
          <article class="card">
            <button class="wish" aria-label="Wishlist">♡</button>

            <div class="badge-row">
              @if($p->is_best_seller) <span class="badge">BEST SELLER</span> @endif
              @if($p->is_new) <span class="badge">BARU</span> @endif
              @if($p->is_engraveable) <span class="badge">ENGRAVABLE</span> @endif
            </div>

            <div class="imgwrap">
              <img src="{{ $p->image_url }}" alt="{{ $p->name }}">
            </div>

            <h4 class="name">{{ strtoupper($p->name) }}</h4>
            <p class="desc">{{ $p->short_desc }}</p>

            <div class="rating">
              <span class="stars">★★★★★</span>
              <span class="score">{{ number_format($p->rating, 1) }}</span>
              <span class="count">({{ $p->review_count }})</span>
            </div>

            <select class="select w-full">
              @foreach($p->variants as $v)
                <option>{{ $v->label }}</option>
              @endforeach
            </select>

            <div class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
          </article>
        @endforeach
      </div>

      <div class="pagination">
        {{ $products->links() }}
      </div>
    </section>
  </div>
@endsection