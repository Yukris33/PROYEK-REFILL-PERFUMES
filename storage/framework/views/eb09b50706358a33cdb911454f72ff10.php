

<?php $__env->startSection('title', 'Voucher & Bantuan'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/voucher-bantuan.css?v=4')); ?>"></div>

<?php
  $user = auth()->user();
  $pointsBalance = $user?->points_balance ?? 0;

  $nextVoucher = $vouchers
    ->where('points_cost', '>', $pointsBalance)
    ->sortBy('points_cost')
    ->first();

  $progressTarget = $nextVoucher ? max($nextVoucher->points_cost, 1) : max($pointsBalance, 1);
  $progressPercent = min(100, round(($pointsBalance / $progressTarget) * 100));

  $latestCode = $latestVoucher?->code ?? 'VCR-SCENT-READY';
?>

<section class="vh-page">
  <div class="vh-container">

    <section class="vh-hero">
      <div class="vh-hero__copy">
        <span class="vh-eyebrow">POINT REWARD CENTER</span>
        <h1>Tukar poin jadi voucher, spray, dan benefit refill.</h1>
        <p>
          Kumpulkan poin dari transaksi, return botol, dan aktivitas akun. Saat poin cukup,
          klaim voucher untuk dipakai di halaman scent/refill, atau klaim Free Testing Spray
          untuk mendapatkan QR vending machine.
        </p>

        <div class="vh-hero__actions">
          <a href="#voucher-list" class="vh-btn vh-btn--dark">Lihat Voucher</a>
          <a href="#kendala" class="vh-btn vh-btn--light">Ada Kendala?</a>
        </div>
      </div>

      <div class="vh-wallet">
        <div class="vh-wallet__top">
          <span>Saldo Poin</span>
          <strong><?php echo e($pointsBalance); ?></strong>
          <small>poin tersedia</small>
        </div>

        <div class="vh-wallet__progress">
          <div style="width: <?php echo e($progressPercent); ?>%"></div>
        </div>

        <?php if($nextVoucher): ?>
          <p>
            Butuh <b><?php echo e(max(0, $nextVoucher->points_cost - $pointsBalance)); ?> poin lagi</b>
            untuk klaim <?php echo e($nextVoucher->name); ?>.
          </p>
        <?php else: ?>
          <p>
            Poin kamu sudah cukup untuk reward aktif yang tersedia.
          </p>
        <?php endif; ?>

        <div class="vh-coin-orbit">
          <i></i><i></i><i></i>
        </div>
      </div>
    </section>

    <?php if(session('success')): ?>
      <div class="vh-alert vh-alert--success">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
      <div class="vh-alert vh-alert--error">
        <?php echo e(session('error')); ?>

      </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
      <div class="vh-alert vh-alert--error">
        <strong>Data belum lengkap:</strong><br>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          - <?php echo e($error); ?><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>

    <section class="vh-redeem-guide">
      <div class="vh-section-head">
        <span>HOW TO REDEEM</span>
        <h2>Cara pakai voucher di ScentCycle</h2>
        <p>
          Free Testing Spray menghasilkan QR untuk vending machine. Voucher lain masuk ke akun
          dan dipakai nanti saat checkout/refill.
        </p>
      </div>

      <div class="vh-guide-grid">
        <button class="vh-guide-step is-active" type="button"
          data-guide-title="Pilih Reward"
          data-guide-desc="Pilih Free Testing Spray untuk QR mesin, atau pilih voucher poin untuk dipakai nanti saat checkout/refill."
          data-guide-screen="SELECT REWARD">
          <span>01</span>
          <strong>Pilih Reward</strong>
        </button>

        <button class="vh-guide-step" type="button"
          data-guide-title="Konfirmasi Ketentuan"
          data-guide-desc="Sebelum klaim, sistem akan menampilkan warning. Untuk voucher poin, saldo akan berkurang setelah kamu klik OK."
          data-guide-screen="CONFIRM CLAIM">
          <span>02</span>
          <strong>Konfirmasi</strong>
        </button>

        <button class="vh-guide-step" type="button"
          data-guide-title="QR atau Voucher Akun"
          data-guide-desc="Free Testing Spray mendapatkan QR vending machine. Voucher lain masuk ke akun sebagai checkout voucher."
          data-guide-screen="REWARD READY">
          <span>03</span>
          <strong>Reward Ready</strong>
        </button>

        <button class="vh-guide-step" type="button"
          data-guide-title="Gunakan Reward"
          data-guide-desc="Scan QR Free Spray di mesin, atau pilih voucher saat checkout/refill di halaman scent."
          data-guide-screen="USE REWARD">
          <span>04</span>
          <strong>Gunakan</strong>
        </button>
      </div>

      <div class="vh-guide-preview">
        <div class="vh-guide-machine">
          <div class="vh-guide-machine__screen">
            <small>VOUCHER SYSTEM</small>
            <strong id="vhGuideScreen">SELECT REWARD</strong>
          </div>

          <div class="vh-guide-qr">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
          </div>

          <div class="vh-guide-spray"></div>
          <div class="vh-guide-status">SCAN QR</div>
        </div>

        <div class="vh-guide-copy">
          <h3 id="vhGuideTitle">Pilih Reward</h3>
          <p id="vhGuideDesc">
            Pilih Free Testing Spray untuk QR mesin, atau pilih voucher poin untuk dipakai nanti saat checkout/refill.
          </p>
        </div>
      </div>
    </section>

    <section id="voucher-list" class="vh-voucher-section">
      <div class="vh-section-head">
        <span>AVAILABLE REWARDS</span>
        <h2>Voucher yang bisa kamu klaim</h2>
        <p>
          Free Testing Spray hanya 1x per akun dan memakai QR mesin. Voucher poin lainnya bisa diklaim
          selama saldo poin cukup, lalu dipakai nanti di halaman scent/refill.
        </p>
      </div>

      <div class="vh-voucher-grid">
        <?php $__empty_1 = true; $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php
    $isFree = $voucher->points_cost <= 0;
    $isMachineReward = $voucher->reward_type === 'free_refill';

    $isClaimed = auth()->check()
  ? in_array($voucher->id, $claimedVoucherIds ?? [])
  : false;

    $machineRewardAlreadyClaimed = $isMachineReward && $isClaimed;

    $canClaim = auth()->check()
      && !$machineRewardAlreadyClaimed
      && $pointsBalance >= $voucher->points_cost;
?>

          <article class="vh-voucher-card <?php echo e($canClaim ? 'is-ready' : ''); ?> <?php echo e($machineRewardAlreadyClaimed ? 'is-claimed' : ''); ?>">
            <div class="vh-voucher-card__icon">
              <?php if($voucher->reward_type === 'discount_percent'): ?>
                <i class="bi bi-percent"></i>
              <?php elseif($voucher->reward_type === 'discount_amount'): ?>
                <i class="bi bi-ticket-perforated"></i>
              <?php elseif($voucher->reward_type === 'free_refill'): ?>
                <i class="bi bi-droplet-half"></i>
              <?php else: ?>
                <i class="bi bi-gift"></i>
              <?php endif; ?>
            </div>

            <div class="vh-voucher-card__body">
              <div class="vh-voucher-card__top">
                <span>
    <?php if($isMachineReward): ?>
        FREE QR SPRAY
    <?php elseif($isFree): ?>
        FREE CLAIM
    <?php else: ?>
        POINT REWARD
    <?php endif; ?>
</span>
                <b><?php echo e($voucher->points_cost); ?> poin</b>
              </div>

              <h3><?php echo e($voucher->name); ?></h3>
              <p><?php echo e($voucher->description); ?></p>

           <div class="vh-voucher-meta">
  <?php if($voucher->reward_type === 'discount_percent'): ?>
    <span><?php echo e((int) $voucher->reward_value); ?>% discount</span>
  <?php elseif($voucher->reward_type === 'discount_amount'): ?>
    <span>Rp<?php echo e(number_format((int) $voucher->reward_value, 0, ',', '.')); ?> off</span>
  <?php elseif($voucher->reward_type === 'free_refill'): ?>
    <span><?php echo e((int) $voucher->reward_value); ?>x / ml reward</span>
  <?php else: ?>
    <span>Bonus points</span>
  <?php endif; ?>

  <?php if($isMachineReward): ?>
    <span>QR vending machine</span>
  <?php else: ?>
    <span>Checkout voucher</span>
  <?php endif; ?>
</div>

<?php if(!$isMachineReward): ?>
  <div class="vh-voucher-mini-flow vh-voucher-mini-flow--checkout">
    <span>Klaim</span>
    <i></i>
    <span>Masuk Akun</span>
    <i></i>
    <span>Pakai di Scent</span>
  </div>

  <div class="vh-voucher-note">
    <strong>Ketentuan Voucher</strong>
    <p>
      Poin akan berkurang setelah konfirmasi. Voucher masuk ke akun dan digunakan nanti saat checkout/refill.
    </p>
  </div>
<?php endif; ?>
            </div>

            <form method="POST" action="<?php echo e(route('voucher.claim', $voucher->id)); ?>" class="vh-claim-form">
              <?php echo csrf_field(); ?>

              <input type="hidden" name="confirm_redeem" value="1">

              <?php if($isMachineReward): ?>
                <div class="vh-claim-options">
                  <label>
                    Lokasi Mesin
                    <select name="machine_location" class="vh-location-select" required>
                      <option value="">Pilih lokasi</option>
                      <option value="UMN">UMN</option>
                      <option value="SMS">SMS</option>
                      <option value="AEON BSD">AEON BSD</option>
                    </select>
                  </label>

                  <label>
                    Varian / Stok
                    <select name="voucher_stock_id" class="vh-stock-select" required>
                      <option value="">Pilih lokasi dulu</option>

                      <?php $__currentLoopData = $voucher->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                          $available = max(0, $stock->stock_qty - $stock->reserved_qty);
                        ?>

                        <option
                          value="<?php echo e($stock->id); ?>"
                          data-location="<?php echo e($stock->machine_location); ?>"
                          data-stock="<?php echo e($available); ?>"
                          <?php echo e($available <= 0 ? 'disabled' : ''); ?>

                        >
                          <?php echo e($stock->variant_name); ?> — <?php echo e($stock->machine_location); ?>

                          <?php echo e($available > 0 ? '(' . $available . ' stok)' : '(Stok habis)'); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </label>
                </div>

                <div class="vh-stock-message">
                  Pilih lokasi dan varian terlebih dahulu.
                </div>
              <?php endif; ?>

              <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="vh-claim-btn vh-claim-btn--login">
                  Login untuk Klaim
                </a>
              <?php else: ?>
                <?php if($machineRewardAlreadyClaimed): ?>
                  <button type="button" class="vh-claim-btn" disabled>
                    Sudah Diklaim
                  </button>
                <?php elseif($pointsBalance >= $voucher->points_cost): ?>
                  <button
                    type="submit"
                    class="vh-claim-btn vh-claim-submit"
                    data-points="<?php echo e($voucher->points_cost); ?>"
                    data-voucher-name="<?php echo e($voucher->name); ?>"
                    data-reward-type="<?php echo e($voucher->reward_type); ?>"
                    data-is-free-spray="<?php echo e($isMachineReward ? '1' : '0'); ?>"
                    <?php echo e($isMachineReward ? 'disabled' : ''); ?>

                  >
                    <?php echo e($isMachineReward ? 'Pilih Lokasi Dulu' : 'Klaim Voucher'); ?>

                  </button>
                <?php else: ?>
                  <button type="button" class="vh-claim-btn" disabled>
                    Poin Belum Cukup
                  </button>
                <?php endif; ?>
              <?php endif; ?>
            </form>
          </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="vh-empty">
            Belum ada voucher aktif.
          </div>
        <?php endif; ?>
      </div>
    </section>

    <section class="vh-my-voucher">
      <div class="vh-section-head">
        <span>MY VOUCHER</span>
        <h2>Voucher yang sudah kamu klaim</h2>
        <p>
          QR hanya berlaku untuk Free Testing Spray. Voucher lain akan dipakai nanti di halaman scent/refill.
        </p>
      </div>

      <div class="vh-my-voucher-grid">
        <div class="vh-qr-card">
          <div class="vh-qr-box">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
          </div>

          <div>
            <span>Latest Voucher Code</span>
            <strong><?php echo e($latestCode); ?></strong>

            <?php if($latestVoucher): ?>
              <?php if(($latestVoucher->usage_channel ?? 'checkout') === 'machine_qr'): ?>
                <p><?php echo e($latestVoucher->voucher->name ?? 'Voucher ScentCycle'); ?> · Scan QR di vending machine</p>
              <?php else: ?>
                <p><?php echo e($latestVoucher->voucher->name ?? 'Voucher ScentCycle'); ?> · Gunakan nanti di checkout/refill</p>
              <?php endif; ?>
            <?php else: ?>
              <p>Belum ada voucher diklaim. Klaim voucher untuk membuat kode reward.</p>
            <?php endif; ?>
          </div>
        </div>

        <div class="vh-voucher-list">
          <?php $__empty_1 = true; $__currentLoopData = $claimedVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userVoucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="vh-user-voucher">
              <div>
                <strong><?php echo e($userVoucher->voucher->name ?? 'Voucher'); ?></strong>
                <small><?php echo e($userVoucher->code); ?></small>

                <?php if($userVoucher->machine_location || $userVoucher->variant_name): ?>
                  <small>
                    <?php echo e($userVoucher->machine_location ?? '-'); ?>

                    <?php if($userVoucher->variant_name): ?>
                      · <?php echo e($userVoucher->variant_name); ?>

                    <?php endif; ?>
                  </small>
                <?php endif; ?>
              </div>

              <span class="vh-status vh-status--<?php echo e($userVoucher->status); ?>">
                <?php if(($userVoucher->usage_channel ?? 'checkout') === 'machine_qr'): ?>
                  QR Mesin
                <?php else: ?>
                  Checkout
                <?php endif; ?>
              </span>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="vh-empty">
              Belum ada voucher yang diklaim.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section class="vh-form-section">
      <div id="kendala" class="vh-form-card">
        <div class="vh-form-card__head">
          <span class="vh-form-icon vh-form-icon--danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
          </span>
          <div>
            <span>SUPPORT TICKET</span>
            <h2>Ada Kendala?</h2>
            <p>Laporkan masalah pada mesin, transaksi, voucher, atau kendala lainnya.</p>
          </div>
        </div>

        <form method="POST" action="<?php echo e(route('support.ticket.store')); ?>" class="vh-form">
          <?php echo csrf_field(); ?>

          <div class="vh-input-row">
            <label>
              Kategori
              <select name="category" required>
                <option value="">Pilih kategori</option>
                <option value="mesin">Mesin</option>
                <option value="transaksi">Transaksi</option>
                <option value="voucher">Voucher</option>
                <option value="lainnya">Lainnya</option>
              </select>
            </label>

            <label>
              Subjek
              <input type="text" name="subject" placeholder="Contoh: QR voucher tidak terbaca" required>
            </label>
          </div>

          <label>
            Deskripsi Kendala
            <textarea name="description" rows="5" placeholder="Ceritakan kendala kamu secara detail..." required></textarea>
          </label>

          <button type="submit" class="vh-submit-btn">
            Kirim Laporan
          </button>
        </form>

        <?php if(auth()->guard()->check()): ?>
          <div class="vh-ticket-history">
            <h3>Riwayat Laporan Terbaru</h3>

            <?php $__empty_1 = true; $__currentLoopData = $supportTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <div class="vh-ticket-item">
                <div>
                  <strong><?php echo e($ticket->subject); ?></strong>
                  <small><?php echo e(ucfirst($ticket->category)); ?> · <?php echo e($ticket->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB</small>
                </div>
                <span><?php echo e(ucfirst(str_replace('_', ' ', $ticket->status))); ?></span>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <p>Belum ada laporan.</p>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="vh-form-card">
        <div class="vh-form-card__head">
          <span class="vh-form-icon vh-form-icon--brief">
            <i class="bi bi-briefcase-fill"></i>
          </span>
          <div>
            <span>PARTNERSHIP</span>
            <h2>Kerja Sama</h2>
            <p>Ajukan lokasi vending machine, event support, atau kerja sama brand.</p>
          </div>
        </div>

        <form method="POST" action="<?php echo e(route('partnership.store')); ?>" class="vh-form">
          <?php echo csrf_field(); ?>

          <div class="vh-input-row">
            <label>
              Nama
              <input type="text" name="name" value="<?php echo e(auth()->user()->name ?? ''); ?>" required>
            </label>

            <label>
              Email
              <input type="email" name="email" value="<?php echo e(auth()->user()->email ?? ''); ?>" required>
            </label>
          </div>

          <div class="vh-input-row">
            <label>
              Nomor HP
              <input type="text" name="phone" value="<?php echo e(auth()->user()->phone ?? ''); ?>" placeholder="08xxxxxxxxxx">
            </label>

            <label>
              Nama Bisnis / Lokasi
              <input type="text" name="business_name" placeholder="Contoh: AEON BSD / Event Campus">
            </label>
          </div>

          <label>
            Detail Kerja Sama
            <textarea name="message" rows="5" placeholder="Ceritakan kebutuhan kerja sama, lokasi, estimasi traffic, atau bentuk support yang dibutuhkan..." required></textarea>
          </label>

          <button type="submit" class="vh-submit-btn vh-submit-btn--dark">
            Kirim Request Kerja Sama
          </button>
        </form>
      </div>
    </section>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const guideButtons = document.querySelectorAll('.vh-guide-step');
  const screen = document.getElementById('vhGuideScreen');
  const title = document.getElementById('vhGuideTitle');
  const desc = document.getElementById('vhGuideDesc');

  guideButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      guideButtons.forEach(function(item) {
        item.classList.remove('is-active');
      });

      btn.classList.add('is-active');

      if (screen) screen.textContent = btn.dataset.guideScreen || '';
      if (title) title.textContent = btn.dataset.guideTitle || '';
      if (desc) desc.textContent = btn.dataset.guideDesc || '';
    });
  });

  document.querySelectorAll('.vh-claim-form').forEach(function(form) {
    const locationSelect = form.querySelector('.vh-location-select');
    const stockSelect = form.querySelector('.vh-stock-select');
    const message = form.querySelector('.vh-stock-message');
    const submitBtn = form.querySelector('.vh-claim-submit');

    if (!submitBtn) return;

    const isFreeSpray = submitBtn.dataset.isFreeSpray === '1';

    if (isFreeSpray && locationSelect && stockSelect && message) {
      const allOptions = Array.from(stockSelect.querySelectorAll('option'));

      function refreshStockOptions() {
        const selectedLocation = locationSelect.value;

        stockSelect.value = '';

        allOptions.forEach(function(option) {
          if (!option.value) {
            option.hidden = false;
            return;
          }

          const location = option.dataset.location;
          option.hidden = selectedLocation && location !== selectedLocation;
        });

        if (!selectedLocation) {
          message.textContent = 'Pilih lokasi mesin terlebih dahulu.';
          message.classList.remove('is-ok');
          message.classList.add('is-warning');

          submitBtn.disabled = true;
          submitBtn.textContent = 'Pilih Lokasi Dulu';
          return;
        }

        message.textContent = 'Pilih varian Free Testing Spray yang tersedia di lokasi ' + selectedLocation + '.';
        message.classList.remove('is-ok');
        message.classList.add('is-warning');

        submitBtn.disabled = true;
        submitBtn.textContent = 'Pilih Varian Dulu';
      }

      function validateSelectedStock() {
        const selected = stockSelect.options[stockSelect.selectedIndex];

        if (!selected || !selected.value) {
          submitBtn.disabled = true;
          submitBtn.textContent = 'Pilih Varian Dulu';

          message.textContent = 'Pilih varian Free Testing Spray terlebih dahulu.';
          message.classList.remove('is-ok');
          message.classList.add('is-warning');
          return;
        }

        const stock = parseInt(selected.dataset.stock || '0', 10);

        if (stock <= 0) {
          message.textContent = 'Stok habis. Silakan pilih varian atau lokasi lain.';
          message.classList.remove('is-ok');
          message.classList.add('is-warning');

          submitBtn.disabled = true;
          submitBtn.textContent = 'Stok Habis';
          return;
        }

        message.textContent = 'Stok tersedia: ' + stock + '. Kamu bisa lanjut klaim Free Testing Spray.';
        message.classList.add('is-ok');
        message.classList.remove('is-warning');

        submitBtn.disabled = false;
        submitBtn.textContent = 'Klaim Free Spray';
      }

      locationSelect.addEventListener('change', refreshStockOptions);
      stockSelect.addEventListener('change', validateSelectedStock);

      refreshStockOptions();
    }

    form.addEventListener('submit', function(e) {
      const points = submitBtn.dataset.points || '0';
      const voucherName = submitBtn.dataset.voucherName || 'Voucher';

      let confirmMessage = '';

      if (isFreeSpray) {
        const selected = stockSelect ? stockSelect.options[stockSelect.selectedIndex] : null;

        if (!selected || !selected.value) {
          e.preventDefault();
          alert('Pilih lokasi dan varian Free Testing Spray dulu.');
          return;
        }

        const stock = parseInt(selected.dataset.stock || '0', 10);

        if (stock <= 0) {
          e.preventDefault();
          alert('Stok habis. Silakan pilih lokasi atau varian lain.');
          return;
        }

        confirmMessage =
          'Klaim Free Testing Spray?\n\n' +
          'Ketentuan:\n' +
          '- Berlaku maksimal 1x per akun.\n' +
          '- QR hanya bisa digunakan 1x di vending machine.\n' +
          '- Wajib digunakan sesuai lokasi yang dipilih.\n' +
          '- Stok akan di-reserve setelah kamu konfirmasi.\n\n' +
          'Lokasi: ' + locationSelect.value + '\n' +
          'Varian: ' + selected.textContent.trim();
      } else {
        confirmMessage =
          'Klaim ' + voucherName + '?\n\n' +
          'Ketentuan:\n' +
          '- Poin kamu akan berkurang ' + points + ' poin.\n' +
          '- Voucher akan masuk ke akun kamu.\n' +
          '- Voucher ini dipakai nanti di halaman scent/refill.\n' +
          '- Voucher tidak menggunakan QR vending machine.\n' +
          '- Voucher hanya bisa digunakan 1x saat checkout/refill.\n\n' +
          'Lanjut klaim voucher ini?';
      }

      if (!confirm(confirmMessage)) {
        e.preventDefault();
      }
    });
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/voucher-bantuan.blade.php ENDPATH**/ ?>