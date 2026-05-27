

<?php $__env->startSection('title', 'History'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/history.css?v=2')); ?>"></div>

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
        <strong><?php echo e($orders->count()); ?></strong>
      </div>

      <div class="history-stat">
        <span>Saldo Poin</span>
        <strong><?php echo e(auth()->user()->points_balance ?? 0); ?></strong>
      </div>

      <div class="history-stat">
        <span>Return Botol</span>
        <strong><?php echo e($bottleReturns->count()); ?></strong>
      </div>

      <div class="history-stat">
        <span>Transaksi Poin</span>
        <strong><?php echo e($pointTransactions->count()); ?></strong>
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

    
    <div class="history-panel is-active" data-history-panel="orders">
      <div class="history-card history-card--premium">
        <div class="history-card__head">
          <div>
            <span>TRANSACTION</span>
            <h2>History Pembelian</h2>
          </div>
          <strong><?php echo e($orders->count()); ?> order</strong>
        </div>

        <div class="history-list">
            <?php if(session('success')): ?>
  <div class="history-review-alert history-review-alert--success">
    <?php echo e(session('success')); ?>

  </div>
<?php endif; ?>

<?php if(session('error')): ?>
  <div class="history-review-alert history-review-alert--error">
    <?php echo e(session('error')); ?>

  </div>
<?php endif; ?>
          <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="history-order history-search-item"
              data-search="<?php echo e(strtolower($order->order_code . ' ' . $order->status . ' ' . $order->payment_status . ' ' . $order->items->pluck('product_name_snapshot')->join(' '))); ?>">

              <button type="button" class="history-accordion">
                <div>
                  <strong><?php echo e($order->order_code); ?></strong>
                  <small><?php echo e($order->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB</small>
                </div>

                <div class="history-status">
                  <span><?php echo e(ucfirst($order->status)); ?></span>
                  <b><?php echo e(ucfirst($order->payment_status)); ?></b>
                </div>

                <i class="bi bi-chevron-down"></i>
              </button>

              <div class="history-accordion-body">
                <div class="history-order__items">
                  <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $category = optional($item->product)->category;
                      $typeLabel = $category === 'bottle' ? 'Botol' : 'Scent';
                    ?>

                    <div class="history-item history-item--reviewable">
  <div class="history-item__main">
    <div>
      <span><?php echo e($typeLabel); ?></span>
      <strong><?php echo e($item->product_name_snapshot); ?></strong>
      <small>
        <?php echo e($item->size_snapshot ?? '-'); ?> · Qty <?php echo e($item->qty); ?>

      </small>
    </div>

    <b>Rp<?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></b>
  </div>

  <?php if($order->payment_status === 'paid'): ?>
    <div class="history-review-area">

      <?php if(!$item->review): ?>
        <button
          type="button"
          class="history-review-toggle"
          data-review-toggle="review-form-<?php echo e($item->id); ?>"
        >
          Beri Rating
        </button>

        <div
          class="history-review-form-wrap"
          id="review-form-<?php echo e($item->id); ?>"
        >
          <form
            action="<?php echo e(route('reviews.store', $item->id)); ?>"
            method="POST"
            class="history-review-form"
          >
            <?php echo csrf_field(); ?>

            <div class="history-star-rating">
              <input type="radio" id="history-star5-<?php echo e($item->id); ?>" name="rating" value="5">
              <label for="history-star5-<?php echo e($item->id); ?>">★</label>

              <input type="radio" id="history-star4-<?php echo e($item->id); ?>" name="rating" value="4">
              <label for="history-star4-<?php echo e($item->id); ?>">★</label>

              <input type="radio" id="history-star3-<?php echo e($item->id); ?>" name="rating" value="3">
              <label for="history-star3-<?php echo e($item->id); ?>">★</label>

              <input type="radio" id="history-star2-<?php echo e($item->id); ?>" name="rating" value="2">
              <label for="history-star2-<?php echo e($item->id); ?>">★</label>

              <input type="radio" id="history-star1-<?php echo e($item->id); ?>" name="rating" value="1">
              <label for="history-star1-<?php echo e($item->id); ?>">★</label>
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
      <?php else: ?>
        <div class="history-review-saved">
          <div class="history-review-saved__top">
            <strong>Ulasan Kamu</strong>

            <div class="history-review-saved__stars">
              <?php for($i = 1; $i <= 5; $i++): ?>
                <?php echo e($i <= $item->review->rating ? '★' : '☆'); ?>

              <?php endfor; ?>
            </div>
          </div>

          <p>
            <?php echo e($item->review->comment ?: 'Tidak ada komentar.'); ?>

          </p>
        </div>
      <?php endif; ?>

    </div>
  <?php endif; ?>
</div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="history-order__bottom">
                  <span>Total: <strong>Rp<?php echo e(number_format($order->grand_total, 0, ',', '.')); ?></strong></span>
                  <span>Poin didapat: <strong>+<?php echo e($order->points_earned ?? 0); ?></strong></span>
                </div>
              </div>
            </article>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="history-empty">
              Belum ada history pembelian.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    
    <div class="history-panel" data-history-panel="points">
      <div class="history-card history-card--premium">
        <div class="history-card__head">
          <div>
            <span>POINT WALLET</span>
            <h2>History Poin</h2>
          </div>
          <strong><?php echo e(auth()->user()->points_balance ?? 0); ?> poin</strong>
        </div>

        <div class="history-timeline">
          <?php $__empty_1 = true; $__currentLoopData = $pointTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="history-point history-search-item"
              data-search="<?php echo e(strtolower(($point->description ?? '') . ' ' . $point->type . ' ' . $point->points)); ?>">

              <div class="history-point__dot"></div>

              <div class="history-point__content">
                <div>
                  <strong>
                    <?php echo e($point->type === 'redeem' ? '-' : '+'); ?><?php echo e($point->points); ?> poin
                  </strong>
                  <small><?php echo e($point->description ?? 'Transaksi poin'); ?></small>
                  <em><?php echo e(\Carbon\Carbon::parse($point->created_at)->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB</em>
                </div>

                <span class="history-badge history-badge--<?php echo e($point->type); ?>">
                  <?php echo e(ucfirst($point->type)); ?>

                </span>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="history-empty">
              Belum ada transaksi poin.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    
    <div class="history-panel" data-history-panel="returns">
      <div class="history-card history-card--premium">
        <div class="history-card__head">
          <div>
            <span>BOTTLE RETURN</span>
            <h2>History Return Botol</h2>
          </div>
          <strong><?php echo e($bottleReturns->count()); ?> return</strong>
        </div>

        <div class="history-return-grid">
          <?php $__empty_1 = true; $__currentLoopData = $bottleReturns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="history-return history-search-item"
              data-search="<?php echo e(strtolower($return->return_code . ' ' . $return->machine_location . ' ' . $return->status)); ?>">

              <div class="history-return__top">
                <div>
                  <strong><?php echo e($return->return_code); ?></strong>
                  <small><?php echo e($return->machine_location); ?></small>
                </div>

                <span class="history-badge history-badge--<?php echo e($return->status); ?>">
                  <?php echo e(ucfirst($return->status)); ?>

                </span>
              </div>

              <div class="history-return__meta">
                <span>Total botol <b><?php echo e($return->total_bottles); ?></b></span>
                <span>Estimasi <b><?php echo e($return->estimated_points); ?> poin</b></span>
                <span>Masuk <b><?php echo e($return->awarded_points); ?> poin</b></span>
              </div>

              <div class="history-return__progress">
                <div class="<?php echo e($return->status === 'pending' || $return->status === 'success' || $return->status === 'failed' ? 'is-on' : ''); ?>"></div>
                <div class="<?php echo e($return->status === 'success' || $return->status === 'failed' ? 'is-on' : ''); ?>"></div>
                <div class="<?php echo e($return->status === 'success' ? 'is-success' : ($return->status === 'failed' ? 'is-failed' : '')); ?>"></div>
              </div>

              <a href="<?php echo e(route('return.botol.status', $return->return_code)); ?>" class="history-link">
                Lihat Status Return
              </a>
            </article>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="history-empty">
              Belum ada return botol.
            </div>
          <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/history/index.blade.php ENDPATH**/ ?>