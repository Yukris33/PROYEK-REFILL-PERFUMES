@extends('layouts.app')

@section('title', 'History')

@section('content')
<div data-page-css="{{ asset('css/history.css?v=2') }}"></div>

<section class="history-page">
  <div class="history-container">

    <div class="history-hero">
      <span>USER ACTIVITY CENTER</span>
      <h1>History Aktivitas</h1>
      <p>
        Pantau pembelian scent, pembelian botol, return botol, dan semua pergerakan poin akun kamu
        dalam satu halaman yang rapi dan interaktif.
      </p>
    </div>

    <div class="history-stats">
      <div class="history-stat">
        <span>Total Order</span>
        <strong>{{ $orders->count() }}</strong>
      </div>

      <div class="history-stat">
        <span>Saldo Poin</span>
        <strong>{{ auth()->user()->points_balance ?? 0 }}</strong>
      </div>

      <div class="history-stat">
        <span>Return Botol</span>
        <strong>{{ $bottleReturns->count() }}</strong>
      </div>

      <div class="history-stat">
        <span>Transaksi Poin</span>
        <strong>{{ $pointTransactions->count() }}</strong>
      </div>
    </div>

    <div class="history-toolbar">
      <div class="history-tabs">
        <button type="button" class="history-tab is-active" data-history-tab="orders">
          Pembelian
        </button>

        <button type="button" class="history-tab" data-history-tab="points">
          Poin
        </button>

        <button type="button" class="history-tab" data-history-tab="returns">
          Return Botol
        </button>
      </div>

      <div class="history-search-wrap">
        <i class="bi bi-search"></i>
        <input type="text" id="historySearch" placeholder="Cari order, produk, kode return, atau poin...">
      </div>
    </div>

    {{-- ORDERS --}}
    <div class="history-panel is-active" data-history-panel="orders">
      <div class="history-card history-card--premium">
        <div class="history-card__head">
          <div>
            <span>TRANSACTION</span>
            <h2>History Pembelian</h2>
          </div>
          <strong>{{ $orders->count() }} order</strong>
        </div>

        <div class="history-list">
            @if(session('success'))
  <div class="history-review-alert history-review-alert--success">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="history-review-alert history-review-alert--error">
    {{ session('error') }}
  </div>
@endif
          @forelse($orders as $order)
            <article class="history-order history-search-item"
              data-search="{{ strtolower($order->order_code . ' ' . $order->status . ' ' . $order->payment_status . ' ' . $order->items->pluck('product_name_snapshot')->join(' ')) }}">

              <button type="button" class="history-accordion">
                <div>
                  <strong>{{ $order->order_code }}</strong>
                  <small>{{ $order->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</small>
                </div>

                <div class="history-status">
                  <span>{{ ucfirst($order->status) }}</span>
                  <b>{{ ucfirst($order->payment_status) }}</b>
                </div>

                <i class="bi bi-chevron-down"></i>
              </button>

              <div class="history-accordion-body">
                <div class="history-order__items">
                  @foreach($order->items as $item)
                    @php
                      $category = optional($item->product)->category;
                      $typeLabel = $category === 'bottle' ? 'Botol' : 'Scent';
                    @endphp

                    <div class="history-item history-item--reviewable">
  <div class="history-item__main">
    <div>
      <span>{{ $typeLabel }}</span>
      <strong>{{ $item->product_name_snapshot }}</strong>
      <small>
        {{ $item->size_snapshot ?? '-' }} · Qty {{ $item->qty }}
      </small>
    </div>

    <b>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</b>
  </div>

  @if($order->payment_status === 'paid')
    <div class="history-review-area">

      @if(!$item->review)
        <button
          type="button"
          class="history-review-toggle"
          data-review-toggle="review-form-{{ $item->id }}"
        >
          Beri Rating
        </button>

        <div
          class="history-review-form-wrap"
          id="review-form-{{ $item->id }}"
        >
          <form
            action="{{ route('reviews.store', $item->id) }}"
            method="POST"
            class="history-review-form"
          >
            @csrf

            <div class="history-star-rating">
              <input type="radio" id="history-star5-{{ $item->id }}" name="rating" value="5">
              <label for="history-star5-{{ $item->id }}">★</label>

              <input type="radio" id="history-star4-{{ $item->id }}" name="rating" value="4">
              <label for="history-star4-{{ $item->id }}">★</label>

              <input type="radio" id="history-star3-{{ $item->id }}" name="rating" value="3">
              <label for="history-star3-{{ $item->id }}">★</label>

              <input type="radio" id="history-star2-{{ $item->id }}" name="rating" value="2">
              <label for="history-star2-{{ $item->id }}">★</label>

              <input type="radio" id="history-star1-{{ $item->id }}" name="rating" value="1">
              <label for="history-star1-{{ $item->id }}">★</label>
            </div>

            <div class="history-review-text">
              Pilih rating 1 sampai 5 bintang.
            </div>

            <div class="history-review-comment-wrap">
              <textarea
                name="comment"
                class="history-review-textarea"
                maxlength="500"
                placeholder="Tulis komentar kamu tentang produk ini..."
              ></textarea>
            </div>

            <button type="submit" class="history-review-submit">
              Kirim Rating
            </button>
          </form>
        </div>
      @else
        <div class="history-review-saved">
          <div class="history-review-saved__top">
            <strong>Ulasan Kamu</strong>

            <div class="history-review-saved__stars">
              @for($i = 1; $i <= 5; $i++)
                {{ $i <= $item->review->rating ? '★' : '☆' }}
              @endfor
            </div>
          </div>

          <p>
            {{ $item->review->comment ?: 'Tidak ada komentar.' }}
          </p>
        </div>
      @endif

    </div>
  @endif
</div>
                  @endforeach
                </div>

                <div class="history-order__bottom">
                  <span>Total: <strong>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</strong></span>
                  <span>Poin didapat: <strong>+{{ $order->points_earned ?? 0 }}</strong></span>
                </div>
              </div>
            </article>
          @empty
            <div class="history-empty">
              Belum ada history pembelian.
            </div>
          @endforelse
        </div>
      </div>
    </div>

    {{-- POINTS --}}
    <div class="history-panel" data-history-panel="points">
      <div class="history-card history-card--premium">
        <div class="history-card__head">
          <div>
            <span>POINT WALLET</span>
            <h2>History Poin</h2>
          </div>
          <strong>{{ auth()->user()->points_balance ?? 0 }} poin</strong>
        </div>

        <div class="history-timeline">
          @forelse($pointTransactions as $point)
            <div class="history-point history-search-item"
              data-search="{{ strtolower(($point->description ?? '') . ' ' . $point->type . ' ' . $point->points) }}">

              <div class="history-point__dot"></div>

              <div class="history-point__content">
                <div>
                  <strong>
                    {{ $point->type === 'redeem' ? '-' : '+' }}{{ $point->points }} poin
                  </strong>
                  <small>{{ $point->description ?? 'Transaksi poin' }}</small>
                  <em>{{ \Carbon\Carbon::parse($point->created_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</em>
                </div>

                <span class="history-badge history-badge--{{ $point->type }}">
                  {{ ucfirst($point->type) }}
                </span>
              </div>
            </div>
          @empty
            <div class="history-empty">
              Belum ada transaksi poin.
            </div>
          @endforelse
        </div>
      </div>
    </div>

    {{-- RETURNS --}}
    <div class="history-panel" data-history-panel="returns">
      <div class="history-card history-card--premium">
        <div class="history-card__head">
          <div>
            <span>BOTTLE RETURN</span>
            <h2>History Return Botol</h2>
          </div>
          <strong>{{ $bottleReturns->count() }} return</strong>
        </div>

        <div class="history-return-grid">
          @forelse($bottleReturns as $return)
            <article class="history-return history-search-item"
              data-search="{{ strtolower($return->return_code . ' ' . $return->machine_location . ' ' . $return->status) }}">

              <div class="history-return__top">
                <div>
                  <strong>{{ $return->return_code }}</strong>
                  <small>{{ $return->machine_location }}</small>
                </div>

                <span class="history-badge history-badge--{{ $return->status }}">
                  {{ ucfirst($return->status) }}
                </span>
              </div>

              <div class="history-return__meta">
                <span>Total botol <b>{{ $return->total_bottles }}</b></span>
                <span>Estimasi <b>{{ $return->estimated_points }} poin</b></span>
                <span>Masuk <b>{{ $return->awarded_points }} poin</b></span>
              </div>

              <div class="history-return__progress">
                <div class="{{ $return->status === 'pending' || $return->status === 'success' || $return->status === 'failed' ? 'is-on' : '' }}"></div>
                <div class="{{ $return->status === 'success' || $return->status === 'failed' ? 'is-on' : '' }}"></div>
                <div class="{{ $return->status === 'success' ? 'is-success' : ($return->status === 'failed' ? 'is-failed' : '') }}"></div>
              </div>

              <a href="{{ route('return.botol.status', $return->return_code) }}" class="history-link">
                Lihat Status Return
              </a>
            </article>
          @empty
            <div class="history-empty">
              Belum ada return botol.
            </div>
          @endforelse
        </div>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('[data-history-tab]');
  const panels = document.querySelectorAll('[data-history-panel]');
  const searchInput = document.getElementById('historySearch');

  function setActivePanel(name) {
    tabs.forEach(function(tab) {
      tab.classList.toggle('is-active', tab.dataset.historyTab === name);
    });

    panels.forEach(function(panel) {
      panel.classList.toggle('is-active', panel.dataset.historyPanel === name);
    });

    if (searchInput) searchInput.value = '';
    filterVisiblePanel('');
  }

  function filterVisiblePanel(keyword) {
    const activePanel = document.querySelector('.history-panel.is-active');
    if (!activePanel) return;

    const items = activePanel.querySelectorAll('.history-search-item');
    const cleanKeyword = keyword.trim().toLowerCase();

    items.forEach(function(item) {
      const text = item.dataset.search || '';
      item.style.display = text.includes(cleanKeyword) ? '' : 'none';
    });
  }

  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      setActivePanel(tab.dataset.historyTab);
    });
  });

  if (searchInput) {
    searchInput.addEventListener('input', function() {
      filterVisiblePanel(searchInput.value);
    });
  }

  document.querySelectorAll('.history-accordion').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const order = btn.closest('.history-order');
      if (!order) return;
      order.classList.toggle('is-open');
    });
  });

   document.querySelectorAll('[data-review-toggle]').forEach(function(button) {
    button.addEventListener('click', function() {
      const targetId = button.dataset.reviewToggle;
      const formWrap = document.getElementById(targetId);

      if (!formWrap) return;

      formWrap.classList.toggle('is-show');

      button.textContent = formWrap.classList.contains('is-show')
        ? 'Tutup Rating'
        : 'Beri Rating';
    });
  });

  document.querySelectorAll('.history-review-form').forEach(function(form) {
    const stars = form.querySelectorAll('input[name="rating"]');
    const commentWrap = form.querySelector('.history-review-comment-wrap');
    const ratingText = form.querySelector('.history-review-text');
    const submitBtn = form.querySelector('.history-review-submit');

    stars.forEach(function(star) {
      star.addEventListener('change', function() {
        if (commentWrap) {
          commentWrap.classList.add('is-show');
        }

        if (submitBtn) {
        submitBtn.classList.add('is-show');
      }

        if (ratingText) {
          ratingText.textContent = `Kamu memilih ${this.value} dari 5 bintang. Tambahkan komentar jika ingin.`;
        }
      });
    });
  });
});
</script>
@endsection