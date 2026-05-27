
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
        <a href="<?php echo e(url('/')); ?>" class="brand">Perfume Store</a>
    </div>

    <div class="topbar__right">

        <?php if(auth()->guard()->check()): ?>
            <div class="user-menu">

                <a href="#" class="icon-link user-pill">

                    <?php if(auth()->user()->avatar ?? false): ?>
                        <img 
                            src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" 
                            class="user-avatar"
                        >
                    <?php else: ?>
                        <span class="user-avatar user-avatar--fallback">
                            <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                        </span>
                    <?php endif; ?>

                </a>

                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>

            </div>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="icon-link">👤</a>
        <?php endif; ?>


        <?php
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
?>

<a href="<?php echo e(route('cart.index')); ?>" class="icon-link">
    🛒 (<?php echo e($cartCount); ?>)
</a>

    </div>
</div>
  </header>

  <div class="hero-slider" id="heroSlider">
    <button class="hero-prev" type="button">‹</button>

    <div class="hero-viewport">
      <div class="hero-track" id="heroTrack">

        <div class="hero-slide">
          <img src="<?php echo e(asset('img/humans.png')); ?>" alt="Banner 1">
        </div>

        <div class="hero-slide">
          <img src="<?php echo e(asset('img/claire.png')); ?>" alt="Banner 2">
        </div>

        <div class="hero-slide">
          <img src="<?php echo e(asset('img/oullu.jpeg')); ?>" alt="Banner 3">
        </div>

        <div class="hero-slide">
          <img src="<?php echo e(asset('img/collab1.jpeg')); ?>" alt="Banner 4">
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

<?php /**PATH C:\xampp\htdocs\perfume-projek (7)\perfume-projek\resources\views/partials/header.blade.php ENDPATH**/ ?>