

<?php $__env->startSection('title', 'Emerald Cedar Preview - SCENTCYCLE'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/main.css')); ?>"></div>
<link rel="stylesheet" href="<?php echo e(asset('css/preview-product.css')); ?>">

<section class="preview-page" data-page="prestige-preview">
    <div class="preview-wrap">
        <div class="preview-grid">

            <div class="preview-media">
                <div class="preview-media-box">
                    <img src="<?php echo e(asset('img/green.jpeg')); ?>" alt="SCENTC Emerald Cedar Eau De Parfum">
                </div>
            </div>

            <div class="preview-info">
                <div class="preview-kicker">WOODY INTENSE</div>
                <h1 class="preview-title">SCENTC Emerald Cedar Eau De Parfum</h1>

                <?php if(session('error')): ?>
                    <div style="margin-bottom:16px; color:#991b1b;">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div style="margin-bottom:16px; color:#991b1b;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <p class="preview-desc">
                    SCENTC Emerald Cedar menghadirkan aroma woody yang dalam, elegan, dan sophisticated.
                    Kesan awalnya terasa rich dengan sentuhan cedar yang halus, lalu berkembang menjadi
                    wangi yang smooth, deep, dan refined saat dipakai lebih lama.
                </p>

                <p class="preview-desc preview-desc--secondary">
                    Parfum ini cocok untuk kamu yang menyukai aroma kayu yang kuat namun tetap classy.
                    Karakternya terasa modern, maskulin, dan confident, memberikan kesan
                    mahal, tenang, dan berkelas untuk acara formal maupun pemakaian harian.
                </p>

                <div class="preview-notes">
                    <div class="preview-note-item">
                        <span class="label">Character</span>
                        <strong>Deep · Smooth · Sophisticated</strong>
                    </div>

                    <div class="preview-note-item">
                        <span class="label">Category</span>
                        <strong>Eau De Parfum</strong>
                    </div>
                </div>

                <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="addToCartForm">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="product_slug" value="emerald-cedar">
                    <input type="hidden" name="product_name" value="SCENTC Emerald Cedar Eau De Parfum">
                    <input type="hidden" name="product_image" value="img/green.jpeg">
                    <input type="hidden" name="product_brand" value="SCENTC">
                    <input type="hidden" name="product_category" value="refill">
                    <input type="hidden" name="product_description" value="Deep woody parfum">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" id="cartPriceInput">

                    <div class="preview-size-block">
                        <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>

                        <div class="preview-select-wrm">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>
                                <option value="10" data-price="35000">10 ml</option>
                                <option value="20" data-price="49000">20 ml</option>
                                <option value="30" data-price="65000">30 ml</option>
                            </select>
                        </div>
                    </div>

                    <div class="preview-price-box">
                        <span class="preview-price-label">Harga</span>
                        <div class="preview-price-value" id="priceText">Pilih ukuran dulu</div>
                    </div>

                    <div class="preview-actions">
                        <a href="<?php echo e(route('nav.brand')); ?>" class="preview-btn preview-btn--ghost">
                            Kembali
                        </a>

                        <button type="submit" class="preview-btn preview-btn--cart">
                            Masukkan Keranjang
                        </button>

                        <button type="button" class="preview-btn preview-btn--primary" id="buyNowBtn">
                            Beli Sekarang
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<div class="payment-modal" id="paymentModal" style="display:none;">
    <div class="payment-modal__box">
        <button type="button" class="payment-modal__close" id="closePaymentModal">&times;</button>

        <div class="payment-modal__header">
            <h2>Pilih Metode Pembayaran</h2>
            <p>Selesaikan pembelian tanpa pindah halaman.</p>
        </div>

        <div class="payment-modal__content">
            <div class="payment-modal__left">
                <div class="payment-card">
                    <div class="payment-card__title">QRIS</div>
                    <div class="payment-card__subtitle">Scan QR untuk bayar</div>

                    <div class="payment-qris-box">
                        <div class="payment-qris-placeholder">QRIS Preview</div>
                    </div>

                    <div class="payment-card__note">
                        Total:
                        <strong id="paymentTotalText">Rp0</strong>
                    </div>
                </div>
            </div>

            <div class="payment-modal__right">
                <div class="payment-card">
                    <div class="payment-card__title">Metode Lain</div>
                    <div class="payment-card__subtitle">Pilih pembayaran yang kamu mau</div>

                    <div class="payment-method-list">
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BCA">Virtual Account BCA</button>
                        <button type="button" class="payment-method-btn" data-method="Virtual Account BNI">Virtual Account BNI</button>
                        <button type="button" class="payment-method-btn" data-method="Virtual Account Mandiri">Virtual Account Mandiri</button>
                        <button type="button" class="payment-method-btn" data-method="GoPay">GoPay</button>
                        <button type="button" class="payment-method-btn" data-method="ShopeePay">ShopeePay</button>
                        <button type="button" class="payment-method-btn" data-method="DANA">DANA</button>
                    </div>

                    <div class="payment-method-detail" id="paymentMethodDetail">
                        Pilih metode pembayaran dulu.
                    </div>

                    <div class="payment-card__footer">
                        <button type="button" class="payment-confirm-btn" id="confirmPaymentBtn">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('js/preview-product.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/preview/emerald.blade.php ENDPATH**/ ?>