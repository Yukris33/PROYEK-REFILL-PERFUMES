<head>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

  <div class="promo-bar">
      <button class="promo-prev" type="button">‹</button>

      <div class="promo-viewport">
          <div class="promo-track" id="promoTrack">
              <div class="promo-item">
                  DAPATKAN YSL DISCOVERY KIT (3 PCS ITEM) UNTUK PEMBELIAN DIATAS 1,5 JUTA.
                  <a href="#">BELI SEKARANG</a>
              </div>
              <div class="promo-item">
                  GRATIS ONGKIR AREA TERTENTU • MIN BELANJA 300RB
              </div>
              <div class="promo-item">
                  DISKON 10% UNTUK MEMBER BARU • KODE: NEW10
              </div>
          </div>
      </div>

      <button class="promo-next" type="button">›</button>
  </div>

  <!-- HEADER PUTIH DI BAWAHNYA -->
  <header class="topbar">

         <div class="topbar__lang">
          <div class="lang-switch">
              <img src="https://flagcdn.com/w40/id.png"
                   alt="Indonesia"
                   class="lang-flag"
                   onclick="translatePage('id')">

              <img src="https://flagcdn.com/w40/gb.png"
                   alt="English"
                   class="lang-flag"
                   onclick="translatePage('en')">
          </div>
      </div>


      <div class="topbar__inner">
    <div class="topbar__left">
        <a href="{{ url('/') }}" class="brand">Perfume Store</a>
    </div>

    <div class="topbar__right">

        @auth
            <div class="user-menu">

                <a href="#" class="icon-link user-pill">

                    @if(auth()->user()->avatar ?? false)
                        <img 
                            src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                            class="user-avatar"
                        >
                    @else
                        <span class="user-avatar user-avatar--fallback">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    @endif

                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>

            </div>
        @else
            <a href="{{ route('login') }}" class="icon-link">👤</a>
        @endauth


        @php
    $cartCount = 0;

    if (auth()->check()) {
        $activeCart = \App\Models\Cart::with('items')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();
    } else {
        $activeCart = \App\Models\Cart::with('items')
            ->whereNull('user_id')
            ->where('session_id', session()->getId())
            ->where('status', 'active')
            ->first();
    }

    if ($activeCart) {
        $cartCount = $activeCart->items->sum('qty');
    }
@endphp

<a href="{{ route('cart.index') }}" class="icon-link">
    🛒 ({{ $cartCount }})
</a>

    </div>
</div>
  </header>

  <div class="hero-slider" id="heroSlider">
    <button class="hero-prev" type="button">‹</button>

    <div class="hero-viewport">
      <div class="hero-track" id="heroTrack">

        <div class="hero-slide">
          <img src="{{ asset('img/humans.png') }}" alt="Banner 1">
        </div>

        <div class="hero-slide">
          <img src="{{ asset('img/claire.png') }}" alt="Banner 2">
        </div>

        <div class="hero-slide">
          <img src="{{ asset('img/oullu.jpeg') }}" alt="Banner 3">
        </div>

      </div>
    </div>

    <button class="hero-next" type="button">›</button>
  </div>

 


  <!-- JS slider taruh di sini (sebelum tutup body) -->
   <script>
  (function(){
    const track = document.getElementById('promoTrack');
    if(!track) return;

    const items = track.children;
    let i = 0;

    function show(){ track.style.transform = `translateX(-${i * 100}%)`; }
    function next(){ i = (i + 1) % items.length; show(); }
    function prev(){ i = (i - 1 + items.length) % items.length; show(); }

    document.querySelector('.promo-next')?.addEventListener('click', next);
    document.querySelector('.promo-prev')?.addEventListener('click', prev);

    setInterval(next, 3500);
    show();
  })();
  </script>

  <!-- JS HERO SLIDER (3 GAMBAR) -->
  <script>
  (function(){
    const track = document.getElementById('heroTrack');
    if(!track) return;

    const slides = track.children;
    let i = 0;

    function show(){ track.style.transform = `translateX(-${i * 100}%)`; }
    function next(){ i = (i + 1) % slides.length; show(); }
    function prev(){ i = (i - 1 + slides.length) % slides.length; show(); }

    document.querySelector('.hero-next')?.addEventListener('click', next);
    document.querySelector('.hero-prev')?.addEventListener('click', prev);

    setInterval(next, 4000);
    show();
  })();
  </script>

</body>