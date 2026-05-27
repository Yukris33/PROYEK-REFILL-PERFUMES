

<?php $__env->startSection('title', 'Return Botol'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/return.css?v=122')); ?>"></div>

<section class="rb-return-page">
  <div class="rb-return-container">

    <div class="rb-return-hero">
      <span class="rb-return-label">BOTTLE RETURN REQUEST</span>

      <h1>Return Botol & Kumpulkan Poin</h1>

      <p>
        Ajukan return botol kosong melalui website, lalu scan QR return di vending machine Scentcycle.
        Setelah botol masuk ke return bay dan lolos validasi sensor, poin akan diproses ke akun kamu maksimal 1x24 jam.
      </p>

      <div class="rb-return-reward-row">
        <div class="rb-return-reward">
          <strong>+8</strong>
          <span>20ml</span>
        </div>

        <div class="rb-return-reward">
          <strong>+12</strong>
          <span>30ml</span>
        </div>

        <div class="rb-return-reward">
          <strong>+15</strong>
          <span>50ml</span>
        </div>

        <div class="rb-return-reward">
          <strong>+23</strong>
          <span>100ml</span>
        </div>
      </div>
    </div>

    <div class="rb-return-layout">

      
      <div class="rb-return-card">
        <form method="POST" action="<?php echo e(route('return.botol.store')); ?>" id="returnBottleForm">
          <?php echo csrf_field(); ?>

          <div class="rb-return-card__head">
            <span>STEP 01</span>
            <h2>Detail Return Botol</h2>
            <p>
              Pilih lokasi vending machine, jumlah botol yang ingin dikembalikan, dan ukuran masing-masing botol.
              Maksimal 3 botol dalam satu request return.
            </p>
          </div>

          <?php if($errors->any()): ?>
            <div class="rb-status-note" style="background:#fff1f1;color:#991b1b;">
              <strong>Data belum lengkap:</strong>
              <br>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                - <?php echo e($error); ?><br>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>

          <?php if(session('success')): ?>
            <div class="rb-status-note" style="background:#ecfdf3;color:#166534;">
              <?php echo e(session('success')); ?>

            </div>
          <?php endif; ?>

          <div class="rb-return-form">
            <div class="rb-field">
              <label for="returnLocation">Lokasi Vending Machine</label>
              <select id="returnLocation" name="machine_location" required>
  <option value="">Pilih lokasi</option>

  <option value="UMN" <?php echo e(old('machine_location') === 'UMN' ? 'selected' : ''); ?>>
    UMN
  </option>

  <option value="SMS" <?php echo e(old('machine_location') === 'SMS' ? 'selected' : ''); ?>>
    SMS
  </option>

  <option value="AEON BSD" <?php echo e(old('machine_location') === 'AEON BSD' ? 'selected' : ''); ?>>
    AEON BSD
  </option>
</select>
            </div>

            <div class="rb-field">
              <label for="returnQty">Jumlah Botol</label>
              <select id="returnQty" required>
                <option value="">Pilih jumlah</option>
                <option value="1">1 botol</option>
                <option value="2">2 botol</option>
                <option value="3">3 botol</option>
              </select>
            </div>
          </div>

          <div class="rb-bottle-grid" id="returnBottleSizeGrid"></div>

          <div class="rb-return-summary">
            <div>
              <span>Estimasi poin</span>
              <strong id="returnEstimatedPoints">0 poin</strong>
            </div>

            <p>
              Poin belum langsung masuk setelah QR dibuat. Status awal return adalah <b>pending</b>.
              Poin baru masuk jika return dinyatakan <b>success</b> setelah botol discan, masuk ke mesin,
              dan lolos sensor serta quality check maksimal <b>1x24 jam</b>.
            </p>
          </div>

          <div class="rb-return-actions">
            <button type="submit" class="rb-generate-btn" id="generateReturnQrBtn">
              Generate QR Return
            </button>

            <button type="button" class="rb-status-btn" id="checkReturnStatusBtn">
              Cek Status Return
            </button>
          </div>

          <div class="rb-status-note" id="returnStatusNote">
            Belum ada request return yang dibuat. Setelah QR dibuat, kamu akan diarahkan ke halaman status return.
          </div>
        </form>
      </div>

      
      <aside class="rb-return-preview">

        <div class="rb-machine">
          <div class="rb-machine__screen">
            <small>BOTTLE RETURN</small>
            <strong id="rbMachineStatus">WAITING REQUEST</strong>
          </div>

          <div class="rb-machine__qr-slot" id="rbQrSlot">
            <div class="rb-mini-qr">
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
            </div>
          </div>

          <div class="rb-machine__return-bay" id="rbReturnBay">
            <span>RETURN BOTTLE HERE</span>
            <div class="rb-machine__bottle" id="rbMachineBottle"></div>
            <div class="rb-machine__scan" id="rbMachineScan"></div>
          </div>

          <div class="rb-machine__esp">
            <span>ESP32</span>
            <i id="rbEspIndicator"></i>
          </div>

          <div class="rb-machine__status-pill" id="rbMachinePill">
            STANDBY
          </div>
        </div>

        <div class="rb-qr-result" id="returnQrResult" aria-hidden="true">
          <div class="rb-qr-result__code">
            <div class="rb-big-qr">
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
              <span></span><span></span><span></span>
            </div>
          </div>

          <div class="rb-qr-result__copy">
            <span>QR RETURN CODE</span>
            <strong id="returnQrCodeText">RTN-SCENT-0000</strong>
            <p id="returnQrDescription">
              QR return akan dibuat oleh sistem setelah data disubmit dan tersimpan ke database.
            </p>
          </div>
        </div>

      </aside>

    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const returnBottleForm = document.getElementById('returnBottleForm');
  const returnLocation = document.getElementById('returnLocation');
  const returnQty = document.getElementById('returnQty');
  const returnBottleSizeGrid = document.getElementById('returnBottleSizeGrid');
  const returnEstimatedPoints = document.getElementById('returnEstimatedPoints');
  const checkReturnStatusBtn = document.getElementById('checkReturnStatusBtn');
  const returnStatusNote = document.getElementById('returnStatusNote');

  const rbMachineStatus = document.getElementById('rbMachineStatus');
  const rbQrSlot = document.getElementById('rbQrSlot');
  const rbMachinePill = document.getElementById('rbMachinePill');
  const rbMachineBottle = document.getElementById('rbMachineBottle');
  const rbMachineScan = document.getElementById('rbMachineScan');
  const rbEspIndicator = document.getElementById('rbEspIndicator');

  const oldBottleSizes = <?php echo json_encode(old('bottle_sizes', []), 512) ?>;

  const pointMap = {
    '20': 8,
    '30': 12,
    '50': 15,
    '100': 23
  };

  function getBottleSelects() {
    return document.querySelectorAll('.rb-bottle-size-select');
  }

  function calculatePoints() {
    let total = 0;

    getBottleSelects().forEach(function(select) {
      total += pointMap[select.value] || 0;
    });

    if (returnEstimatedPoints) {
      returnEstimatedPoints.textContent = total + ' poin';
    }

    return total;
  }

  function updateMachinePreview() {
    const qty = parseInt(returnQty.value || '0', 10);
    const total = calculatePoints();

    if (qty > 0) {
      rbMachineStatus.textContent = 'FORM READY';
      rbMachinePill.textContent = total > 0 ? 'POINTS READY' : 'SELECT SIZE';
      rbQrSlot.classList.add('is-active');
      rbEspIndicator.classList.add('is-active');
    } else {
      rbMachineStatus.textContent = 'WAITING REQUEST';
      rbMachinePill.textContent = 'STANDBY';
      rbQrSlot.classList.remove('is-active');
      rbEspIndicator.classList.remove('is-active');
    }
  }

  function renderBottleInputs(qty, selectedSizes = []) {
    if (!returnBottleSizeGrid) return;

    returnBottleSizeGrid.innerHTML = '';

    for (let i = 1; i <= qty; i++) {
      const selectedValue = selectedSizes[i - 1] || '';

      const card = document.createElement('div');
      card.className = 'rb-bottle-card';

      card.innerHTML = `
        <span>${i}</span>
        <label>Ukuran Botol ${i}</label>
        <select class="rb-bottle-size-select" name="bottle_sizes[]" required>
          <option value="">Pilih ukuran</option>
          <option value="20" ${selectedValue == '20' ? 'selected' : ''}>20ml (+8 poin)</option>
          <option value="30" ${selectedValue == '30' ? 'selected' : ''}>30ml (+12 poin)</option>
          <option value="50" ${selectedValue == '50' ? 'selected' : ''}>50ml (+15 poin)</option>
          <option value="100" ${selectedValue == '100' ? 'selected' : ''}>100ml (+23 poin)</option>
        </select>
      `;

      returnBottleSizeGrid.appendChild(card);
    }

    getBottleSelects().forEach(function(select) {
      select.addEventListener('change', function() {
        calculatePoints();
        updateMachinePreview();
      });
    });

    calculatePoints();
    updateMachinePreview();
  }

  function validateReturnForm() {
    const location = returnLocation ? returnLocation.value : '';
    const qty = returnQty ? parseInt(returnQty.value || '0', 10) : 0;
    const selects = Array.from(getBottleSelects());

    const allSizesFilled = selects.length === qty && selects.every(function(select) {
      return select.value !== '';
    });

    if (!location) {
      alert('Pilih lokasi vending machine dulu.');
      return false;
    }

    if (!qty) {
      alert('Pilih jumlah botol yang ingin direturn.');
      return false;
    }

    if (qty > 3) {
      alert('Maksimal 3 botol dalam satu request return.');
      return false;
    }

    if (!allSizesFilled) {
      alert('Pilih ukuran untuk semua botol.');
      return false;
    }

    return true;
  }

  if (returnQty) {
    returnQty.addEventListener('change', function () {
      const qty = parseInt(returnQty.value || '0', 10);
      renderBottleInputs(qty);
    });
  }

  if (returnLocation) {
    returnLocation.addEventListener('change', function () {
      updateMachinePreview();
    });
  }

  if (returnBottleForm) {
    returnBottleForm.addEventListener('submit', function(event) {
      if (!validateReturnForm()) {
        event.preventDefault();
        return;
      }

      if (rbMachineStatus) {
        rbMachineStatus.textContent = 'CREATING QR';
      }

      if (rbMachinePill) {
        rbMachinePill.textContent = 'SAVING';
      }

      if (rbMachineBottle) {
        rbMachineBottle.classList.add('is-inserted');
      }

      if (rbMachineScan) {
        rbMachineScan.classList.add('is-active');
      }

      if (rbEspIndicator) {
        rbEspIndicator.classList.add('is-active');
      }

      if (returnStatusNote) {
        returnStatusNote.textContent =
          'Request return sedang dibuat. Sistem akan menyimpan data ke database dan membuat QR return dengan status pending.';
      }
    });
  }

  if (checkReturnStatusBtn) {
    checkReturnStatusBtn.addEventListener('click', function () {
      alert('Buat QR return dulu. Setelah request tersimpan, kamu akan diarahkan ke halaman status return.');
    });
  }

  if (oldBottleSizes.length > 0) {
    returnQty.value = oldBottleSizes.length;
    renderBottleInputs(oldBottleSizes.length, oldBottleSizes);
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/return-botol.blade.php ENDPATH**/ ?>