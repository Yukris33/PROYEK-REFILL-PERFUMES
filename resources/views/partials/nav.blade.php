<nav class="mainnav" id="mainNav">
  <div class="mainnav__inner">

    <!-- Adjustment WRAP (biar panel nempel ke tombol) -->
    <div class="adjwrap">
      <!-- Adjustment button (ID WAJIB buat JS) -->
      <div class="navadjustment" id="adjBtn" role="button" tabindex="0" aria-controls="adjPanel" aria-expanded="false">
        <span class="navadjustment__text">Adjustment</span>
        <i class="bi bi-chevron-down navadjustment__icon"></i>
      </div>

      <!-- PANEL dipindah ke sini biar anchor ke tombol -->
      <div class="adjpanel" id="adjPanel" aria-hidden="true">
        <div class="adjpanel__inner">

          <div class="adjpanel__head">
            <div class="adjpanel__title">
              <i class="bi bi-sliders"></i>
              <span>Filter</span>
            </div>

            <button class="adjpanel__close" type="button" id="adjClose" aria-label="Close">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <div class="adjmenu">

            <!-- SECTION: Discount -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-tag"></i>
                <span>DISCOUNT</span>
              </div>

              <label class="adjitem">
                <span>Promo</span>
                <span class="adjitem__right">
                  <input type="checkbox" name="discount" value="promo">
                </span>
              </label>

              <label class="adjitem">
                <span>Clearance</span>
                <span class="adjitem__right">
                  <input type="checkbox" name="discount" value="clearance">
                </span>
              </label>
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Gender -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-person"></i>
                <span>GENDER</span>
              </div>

              <label class="adjitem">
                <span>Wanita</span>
                <span class="adjitem__right"><input type="checkbox" name="gender" value="wanita"></span>
              </label>

              <label class="adjitem">
                <span>Pria</span>
                <span class="adjitem__right"><input type="checkbox" name="gender" value="pria"></span>
              </label>

              <label class="adjitem">
                <span>Unisex</span>
                <span class="adjitem__right"><input type="checkbox" name="gender" value="unisex"></span>
              </label>
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Harga -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-cash-coin"></i>
                <span>HARGA</span>
              </div>

              <div class="adjprice">
                <div class="adjprice__vals">
                  <span id="priceMinText">Min: 0</span>
                  <span id="priceMaxText">Max: 2000000</span>
                </div>

                <div class="adjprice__range">
                  <input type="range" id="priceMin" min="0" max="2000000" step="50000" value="0">
                  <input type="range" id="priceMax" min="0" max="2000000" step="50000" value="2000000">
                </div>

                <div class="adjprice__hint">Tarik garis untuk atur range harga</div>
              </div>
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Ukuran -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-rulers"></i>
                <span>UKURAN</span>
              </div>

              <div class="adjchips">
                <button type="button" class="adjchip" data-size="10ml">10ml</button>
                <button type="button" class="adjchip" data-size="30ml">30ml</button>
                <button type="button" class="adjchip" data-size="50ml">50ml</button>
                <button type="button" class="adjchip" data-size="100ml">100ml</button>
              </div>
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Flags -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-stars"></i>
                <span>FEATURED</span>
              </div>

              <label class="adjitem">
                <span>New</span>
                <span class="adjitem__right"><input type="checkbox" name="new" value="1"></span>
              </label>

              <label class="adjitem">
                <span>Best Seller</span>
                <span class="adjitem__right"><input type="checkbox" name="bestseller" value="1"></span>
              </label>
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Varian Rasa -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-droplet"></i>
                <span>VARIAN RASA</span>
              </div>

              <label class="adjitem">
                <span>Fresh</span>
                <span class="adjitem__right"><input type="checkbox" name="notes" value="fresh"></span>
              </label>
              <label class="adjitem">
                <span>Sweet</span>
                <span class="adjitem__right"><input type="checkbox" name="notes" value="sweet"></span>
              </label>
              <label class="adjitem">
                <span>Woody</span>
                <span class="adjitem__right"><input type="checkbox" name="notes" value="woody"></span>
              </label>
              <label class="adjitem">
                <span>Floral</span>
                <span class="adjitem__right"><input type="checkbox" name="notes" value="floral"></span>
              </label>
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Brand -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-patch-check"></i>
                <span>BRAND</span>
              </div>
              <input class="adjinput" placeholder="Cari brand...">
            </div>

            <div class="adjdivider"></div>

            <!-- SECTION: Place -->
            <div class="adjsection">
              <div class="adjsection__title">
                <i class="bi bi-geo-alt"></i>
                <span>PLACE</span>
              </div>
              <select class="adjselect">
                <option value="">Semua</option>
                <option>Store</option>
                <option>Vending Machine</option>
                <option>Online</option>
              </select>
            </div>

          </div>

          <div class="adjpanel__foot">
            <button type="button" class="adjbtn adjbtn--ghost" id="adjReset">
              <i class="bi bi-arrow-counterclockwise"></i> Reset
            </button>
            <button type="button" class="adjbtn adjbtn--primary" id="adjApply">
              <i class="bi bi-check2"></i> Apply
            </button>
          </div>

        </div>
      </div>
    </div>
    <!-- /adjwrap -->

    <!-- NAV LINKS -->
    <a href="{{ route('home') }}" class="navlink">Purpose's</a>
    <a href="{{ route('nav.brand') }}" class="navlink">Brand</a>
    <a href="#" class="navlink">Discount</a>
    <a href="#" class="navlink">Place</a>
    <a href="#" class="navlink">FAQ & Vending Mechine</a>
    <a href="{{ route('products.refill') }}" class="navlink">PARFUM</a>

    <!-- SEARCH -->
    <div class="navsearch">
      <i class="bi bi-search navsearch__icon"></i>
      <input class="navsearch__input" placeholder="Cari">
    </div>

  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('adjBtn');
  const panel = document.getElementById('adjPanel');
  const closeBtn = document.getElementById('adjClose');

  if(!btn || !panel) return;

  const chevron = btn.querySelector('.navadjustment__icon');

  function openPanel(){
    panel.classList.add('is-open');
    panel.setAttribute('aria-hidden','false');
    chevron?.classList.add('is-rot');
    btn.setAttribute('aria-expanded','true');
  }

  function closePanel(){
    panel.classList.remove('is-open');
    panel.setAttribute('aria-hidden','true');
    chevron?.classList.remove('is-rot');
    btn.setAttribute('aria-expanded','false');
  }

  btn.addEventListener('click', (e) => {
    e.stopPropagation();
    panel.classList.contains('is-open') ? closePanel() : openPanel();
  });

  closeBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closePanel();
  });

  document.addEventListener('click', (e) => {
    if(panel.classList.contains('is-open') && !panel.contains(e.target) && !btn.contains(e.target)){
      closePanel();
    }
  });

  document.addEventListener('keydown', (e) => {
    if(e.key === 'Escape') closePanel();
  });

  document.querySelectorAll('.adjchip').forEach(chip=>{
    chip.addEventListener('click', ()=>{
      chip.classList.toggle('is-active');
    });
  });
});
</script>

