

<?php $__env->startSection('title', 'Status Return Botol'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/return.css?v=125')); ?>"></div>

<section class="rb-return-page">
  <div class="rb-return-container">

    <div class="rb-return-hero">
      <span class="rb-return-label">RETURN STATUS</span>

      <h1>QR Return Botol Berhasil Dibuat</h1>

      <p>
        Tunjukkan QR return ini di vending machine Scentcycle sesuai lokasi yang dipilih.
        Status awal return adalah pending. Poin baru masuk jika return dinyatakan success oleh sistem.
      </p>

      <div class="rb-return-actions rb-return-hero-actions">
        <a href="<?php echo e(route('products.botol')); ?>" class="rb-status-btn rb-action-link">
          Kembali ke Page Botol
        </a>

        <a href="<?php echo e(route('return.botol')); ?>" class="rb-generate-btn rb-action-link">
          Buat Return Baru
        </a>
      </div>
    </div>

    <div class="rb-return-layout">

      
      <div class="rb-return-card">

        <div class="rb-return-card__head">
          <span><?php echo e(strtoupper($return->status)); ?></span>

          <h2><?php echo e($return->return_code); ?></h2>

          <p>
            Lokasi mesin: <strong><?php echo e($return->machine_location); ?></strong><br>
            Total botol: <strong><?php echo e($return->total_bottles); ?></strong><br>
            Estimasi poin: <strong><?php echo e($return->estimated_points); ?> poin</strong><br>
            Poin masuk: <strong><?php echo e($return->awarded_points); ?> poin</strong>
          </p>
        </div>

        <?php if(session('success')): ?>
          <div class="rb-status-note" style="background:#ecfdf3;color:#166534;">
            <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
          <div class="rb-status-note" style="background:#fff1f1;color:#991b1b;">
            <?php echo e(session('error')); ?>

          </div>
        <?php endif; ?>

        <div class="rb-return-summary">
          <div>
            <span>Status Return</span>

            <?php if($return->status === 'success'): ?>
              <strong>Success</strong>
            <?php elseif($return->status === 'failed'): ?>
              <strong>Failed</strong>
            <?php else: ?>
              <strong>Pending</strong>
            <?php endif; ?>
          </div>

          <?php if($return->status === 'pending'): ?>
            <p>
              Status return masih pending. QR sudah dibuat, tetapi botol belum dinyatakan valid oleh sistem.
              Silakan scan QR di vending machine, masukkan botol ke return bay, lalu tunggu proses sensor dan quality check.
              Poin belum masuk selama status masih pending.
            </p>
          <?php elseif($return->status === 'success'): ?>
            <p>
              Status return success. Botol sudah diterima, lolos validasi sensor dan quality check.
              Poin sebesar <?php echo e($return->awarded_points); ?> poin sudah masuk ke akun kamu.
            </p>
          <?php else: ?>
            <p>
              Status return failed. Botol tidak valid atau tidak lolos quality check.
              Poin tidak masuk ke akun.
            </p>
          <?php endif; ?>
        </div>

        <div class="rb-status-note">
          <strong>Detail botol:</strong>
          <br>

          <?php $__currentLoopData = $return->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            - <?php echo e($item->bottle_size_ml); ?>ml =
            <?php echo e($item->points); ?> poin /
            sensor: <?php echo e($item->sensor_status); ?> /
            kondisi: <?php echo e($item->condition_status); ?>

            <br>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="rb-return-actions">
          <a href="<?php echo e(route('return.botol.status', $return->return_code)); ?>" class="rb-generate-btn rb-action-link">
            Cek Status Return
          </a>

          <a href="<?php echo e(route('nav.voucher-bantuan')); ?>#kendala" class="rb-status-btn rb-action-link">
            Contact Customer
          </a>
        </div>

      </div>

      
      <aside class="rb-return-preview">

        <div class="rb-qr-result is-visible" aria-hidden="false">
          <div class="rb-qr-result__code">
            <div class="rb-big-qr">
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
            </div>
          </div>

          <div class="rb-qr-result__copy">
            <span>QR RETURN CODE</span>
            <strong><?php echo e($return->return_code); ?></strong>
            <p>
              QR ini dibuat setelah kamu klik Generate QR Return.
              Scan kode ini di vending machine lokasi <?php echo e($return->machine_location); ?>.
            </p>
          </div>
        </div>

        <div class="rb-machine rb-machine--status">
          <div class="rb-machine__screen">
            <small>BOTTLE RETURN</small>
            <strong><?php echo e(strtoupper($return->status)); ?></strong>
          </div>

          <div class="rb-machine__qr-slot is-active">
            <div class="rb-mini-qr">
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
            </div>
          </div>

          <div class="rb-machine__return-bay">
            <span>RETURN BOTTLE HERE</span>

            <div class="rb-machine__bottle <?php echo e($return->status !== 'pending' ? 'is-inserted' : ''); ?>"></div>

            <div class="rb-machine__scan <?php echo e($return->status === 'pending' ? 'is-active' : ''); ?>"></div>
          </div>

          <div class="rb-machine__esp">
            <span>ESP32</span>

            <?php if($return->status === 'failed'): ?>
              <i></i>
            <?php else: ?>
              <i class="is-active"></i>
            <?php endif; ?>
          </div>

          <div class="rb-machine__status-pill <?php echo e($return->status === 'success' ? 'is-success' : ''); ?>">
            <?php echo e(strtoupper($return->status)); ?>

          </div>
        </div>

        <div class="rb-status-note rb-status-help-note">
          <strong>Catatan:</strong><br>

          <?php if($return->status === 'pending'): ?>
            Poin akan diproses maksimal <strong>1x24 jam</strong> setelah botol berhasil discan,
            masuk ke return bay, dan lolos pengecekan sensor serta quality check.
          <?php elseif($return->status === 'success'): ?>
            Return sudah dinyatakan success. Poin sudah ditambahkan ke akun kamu dan tercatat di transaksi poin.
          <?php else: ?>
            Return gagal diproses. Jika merasa ada kesalahan, silakan hubungi customer support melalui tombol Contact Customer.
          <?php endif; ?>
        </div>

      </aside>

    </div>

  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/return-botol-status.blade.php ENDPATH**/ ?>