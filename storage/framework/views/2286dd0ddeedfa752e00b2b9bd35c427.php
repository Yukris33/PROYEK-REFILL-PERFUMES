

<?php $__env->startSection('title', 'Status Pesanan'); ?>
<?php
    $paymentAmount = $order->payment->amount ?? $order->grand_total;
    $uniqueCode = $paymentAmount - $order->grand_total;
?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/main.css')); ?>"></div>

<style>

    .qr-refill-box {
    margin-top: 18px;
    padding: 18px;
    border-radius: 18px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    text-align: center;
}

.qr-refill-title {
    font-size: 18px;
    font-weight: 800;
    color: #166534;
    margin-bottom: 10px;
}

.qr-refill-code {
    margin-top: 12px;
    font-size: 13px;
    color: #166534;
    word-break: break-word;
}

.fake-refill-qr {
    width: 190px;
    height: 190px;
    margin: 14px auto;
    background: #fff;
    border: 1px solid #d1fae5;
    border-radius: 16px;
    padding: 14px;
    display: grid;
    place-items: center;
}

.fake-refill-qr-grid {
    width: 150px;
    height: 150px;
    display: grid;
    grid-template-columns: repeat(9, 1fr);
    grid-template-rows: repeat(9, 1fr);
    gap: 3px;
}

.fake-refill-qr-grid span {
    background: #ecfdf5;
    border-radius: 2px;
}

.fake-refill-qr-grid span.dark {
    background: #111;
}

.payment-waiting-box {
    margin-top: 18px;
    padding: 14px;
    border-radius: 14px;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    color: #9a3412;
    font-size: 14px;
    line-height: 1.6;
}


    .status-page {
        width: 100%;
        padding: 44px 0 76px;
        background: #f6f6f6;
    }

    .status-container {
        width: min(1200px, calc(100% - 48px));
        margin: 0 auto;
    }

    .status-header {
        margin-bottom: 26px;
    }

    .status-header h1 {
        font-size: 42px;
        margin: 0 0 8px;
        font-weight: 500;
    }

    .status-header p {
        margin: 0;
        color: #666;
    }

    .status-grid {
        display: grid;
        grid-template-columns: 1.35fr .75fr;
        gap: 26px;
        align-items: start;
    }

    .status-card {
        background: #fff;
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 10px 28px rgba(0,0,0,.05);
    }

    .status-title {
        margin: 0 0 20px;
        font-size: 24px;
        line-height: 1.3;
    }

    .status-info {
        display: grid;
        gap: 12px;
        margin-bottom: 24px;
    }

    .status-row {
        display: flex;
        justify-content: space-between;
        gap: 24px;
        padding-bottom: 12px;
        border-bottom: 1px solid #eee;
    }

    .status-row span {
        color: #666;
        min-width: 170px;
    }

    .status-row strong {
        color: #111;
        text-align: right;
        word-break: break-word;
    }

    .status-items {
        display: grid;
        gap: 14px;
        margin-top: 18px;
    }

    .status-item {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 18px;
        padding: 16px;
        border: 1px solid #eee;
        border-radius: 16px;
        background: #fafafa;
    }

    .status-item-name {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .status-item-meta {
        color: #666;
        font-size: 14px;
    }

    .status-summary-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 14px;
    }

    .status-summary-row span {
        color: #666;
    }

    .status-summary-row strong {
        text-align: right;
    }

    .status-pay-btn {
        width: 100%;
        border: none;
        border-radius: 16px;
        padding: 15px 20px;
        background: #111;
        color: #fff;
        font-weight: 700;
        cursor: pointer;
        margin-top: 12px;
    }

    @media (max-width: 900px) {
        .status-grid {
            grid-template-columns: 1fr;
        }

        .status-row {
            flex-direction: column;
            gap: 4px;
        }

        .status-row strong {
            text-align: left;
        }
    }

.status-left-column {
    display: grid;
    gap: 16px;
}

.status-home-box {
    padding: 16px;
    border: 1px solid #eee;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 10px 28px rgba(0,0,0,.05);
}

.status-home-btn {
    width: 100%;
    display: block;
    text-align: center;
    text-decoration: none;
    border-radius: 14px;
    padding: 15px 18px;
    background: #111;
    color: #fff;
    font-weight: 700;
}

.status-home-btn:hover {
    background: #222;
    color: #fff;
}

.status-summary-row--discount strong{
    color:#166534;
}

/* =========================
   PRODUCT REVIEW - STATUS PESANAN
========================= */
.status-review-box {
    padding: 22px;
    border: 1px solid #eee;
    border-radius: 24px;
    background: #fff;
    box-shadow: 0 10px 28px rgba(0,0,0,.05);
}

.status-review-header {
    margin-bottom: 18px;
}

.status-review-header h2 {
    margin: 0 0 6px;
    font-size: 24px;
    font-weight: 700;
    color: #111;
}

.status-review-header p {
    margin: 0;
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.review-product-card {
    padding: 18px;
    border: 1px solid #eee;
    border-radius: 18px;
    background: #fafafa;
}

.review-product-card + .review-product-card {
    margin-top: 16px;
}

.review-product-name {
    font-size: 16px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
}

.review-product-meta {
    font-size: 14px;
    color: #666;
    margin-bottom: 16px;
}

.review-form {
    display: grid;
    gap: 14px;
}

.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 6px;
    width: fit-content;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 34px;
    line-height: 1;
    color: #d4d4d4;
    cursor: pointer;
    transition: transform .18s ease, color .18s ease;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: #facc15;
}

.star-rating label:hover {
    transform: translateY(-2px) scale(1.08);
}

.review-rating-text {
    font-size: 14px;
    color: #666;
    margin-top: -4px;
}

.review-comment-wrap {
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    transform: translateY(-8px);
    transition: max-height .35s ease, opacity .28s ease, transform .28s ease;
}

.review-comment-wrap.is-show {
    max-height: 240px;
    opacity: 1;
    transform: translateY(0);
}

.review-textarea {
    width: 100%;
    min-height: 110px;
    resize: vertical;
    box-sizing: border-box;
    padding: 14px 15px;
    border: 1px solid #ddd;
    border-radius: 14px;
    background: #fff;
    font-family: inherit;
    font-size: 14px;
    line-height: 1.6;
    outline: none;
}

.review-textarea:focus {
    border-color: #111;
}

.review-submit-btn {
    width: 100%;
    border: none;
    border-radius: 14px;
    padding: 14px 18px;
    background: #111;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease, opacity .28s ease;
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    padding-top: 0;
    padding-bottom: 0;
    border: 0;
    transform: translateY(-8px);
    pointer-events: none;
}

.review-submit-btn.is-show {
    max-height: 60px;
    opacity: 1;
    padding: 14px 18px;
    transform: translateY(0);
    pointer-events: auto;
}

.review-submit-btn:hover {
    background: #222;
    transform: translateY(-1px);
}

.review-alert {
    padding: 13px 15px;
    border-radius: 14px;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 16px;
}

.review-alert--success {
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.review-alert--error {
    background: #fef2f2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.review-saved-box {
    padding: 15px;
    border-radius: 16px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}

.review-saved-title {
    font-weight: 700;
    color: #166534;
    margin-bottom: 10px;
}

.review-saved-stars {
    font-size: 24px;
    letter-spacing: 2px;
    color: #facc15;
    margin-bottom: 10px;
}

.review-saved-comment {
    color: #333;
    line-height: 1.7;
    font-size: 14px;
    margin: 0;
}
</style>

<section class="status-page">
    <div class="status-container">

        <div class="status-header">
            <h1>Status Pesanan</h1>
            <p>Detail transaksi dan status pembayaran pesanan Anda.</p>
        </div>

        <div class="status-grid">

            <div class="status-left-column">
                <div class="status-card">
                    <h2 class="status-title">Detail Pesanan</h2>

                    <div class="status-info">
                        <div class="status-row">
                            <span>Kode Transaksi</span>
                            <strong><?php echo e($order->order_code); ?></strong>
                        </div>

                        <div class="status-row">
                            <span>Tanggal Order</span>
                            <strong><?php echo e($order->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB</strong>
                        </div>

                        <div class="status-row">
                            <span>Status Pesanan</span>
                            <strong><?php echo e(ucfirst($order->status)); ?></strong>
                        </div>

                        <div class="status-row">
                            <span>Status Pembayaran</span>
                            <strong><?php echo e(ucfirst($order->payment_status)); ?></strong>
                        </div>

                        <div class="status-row">
                            <span>Metode Pembayaran</span>
                            <strong><?php echo e($order->payment->method ?? '-'); ?></strong>
                        </div>

                        <div class="status-row">
                            <span>Bonus Poin</span>
                            <strong><?php echo e($order->points_earned > 0 ? $order->points_earned . ' poin' : '-'); ?></strong>
                        </div>
                    </div>

                    <h2 class="status-title">Item Pesanan</h2>

                    <div class="status-items">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="status-item">
                                <div>
                                    <div class="status-item-name"><?php echo e($item->product_name_snapshot); ?></div>
                                    <div class="status-item-meta">
                                        Ukuran: <?php echo e($item->size_snapshot); ?> · Qty: <?php echo e($item->qty); ?>

                                    </div>
                                </div>

                                <strong>
                                    Rp<?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                                </strong>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div> 

                <div class="status-home-box">
                    <a href="<?php echo e(route('home')); ?>" class="status-home-btn">
                        Kembali ke Home
                    </a>
                </div>
                <?php if(
    auth()->check() &&
    $order->user_id === auth()->id() &&
    $order->payment_status === 'paid'
): ?>
    <div class="status-review-box">

        <div class="status-review-header">
            <h2>Rating Produk</h2>
            <p>
                Berikan rating dan komentar untuk produk yang sudah kamu beli.
            </p>
        </div>

        <?php if(session('success')): ?>
            <div class="review-alert review-alert--success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="review-alert review-alert--error">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="review-product-card">

                <div class="review-product-name">
                    <?php echo e($item->product_name_snapshot); ?>

                </div>

                <div class="review-product-meta">
                    Ukuran: <?php echo e($item->size_snapshot); ?> · Qty: <?php echo e($item->qty); ?>

                </div>

                <?php if(!$item->review): ?>
                    <form
                        action="<?php echo e(route('reviews.store', $item->id)); ?>"
                        method="POST"
                        class="review-form"
                    >
                        <?php echo csrf_field(); ?>

                        <div class="star-rating">
                            <input type="radio" id="star5-<?php echo e($item->id); ?>" name="rating" value="5">
                            <label for="star5-<?php echo e($item->id); ?>">★</label>

                            <input type="radio" id="star4-<?php echo e($item->id); ?>" name="rating" value="4">
                            <label for="star4-<?php echo e($item->id); ?>">★</label>

                            <input type="radio" id="star3-<?php echo e($item->id); ?>" name="rating" value="3">
                            <label for="star3-<?php echo e($item->id); ?>">★</label>

                            <input type="radio" id="star2-<?php echo e($item->id); ?>" name="rating" value="2">
                            <label for="star2-<?php echo e($item->id); ?>">★</label>

                            <input type="radio" id="star1-<?php echo e($item->id); ?>" name="rating" value="1">
                            <label for="star1-<?php echo e($item->id); ?>">★</label>
                        </div>

                        <div class="review-rating-text">
                            Pilih rating 1 sampai 5 bintang.
                        </div>

                        <div class="review-comment-wrap">
                            <textarea
                                name="comment"
                                class="review-textarea"
                                maxlength="500"
                                placeholder="Tulis komentar kamu tentang produk ini..."
                            ></textarea>
                        </div>

                        <button type="submit" class="review-submit-btn">
                            Kirim Rating
                        </button>
                    </form>
                <?php else: ?>
                    <div class="review-saved-box">
                        <div class="review-saved-title">
                            Ulasan kamu sudah terkirim
                        </div>

                        <div class="review-saved-stars">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php echo e($i <= $item->review->rating ? '★' : '☆'); ?>

                            <?php endfor; ?>
                        </div>

                        <p class="review-saved-comment">
                            <?php echo e($item->review->comment ?: 'Tidak ada komentar.'); ?>

                        </p>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
<?php endif; ?>
            </div> 

            <div class="status-card">
                <h2 class="status-title">Ringkasan Pembayaran</h2>

                <div class="status-summary-row">
    <span>Subtotal Produk</span>
    <strong>Rp<?php echo e(number_format($order->subtotal, 0, ',', '.')); ?></strong>
</div>

<div class="status-summary-row status-summary-row--discount">
    <span>Diskon Voucher</span>
    <strong>
        <?php echo e($order->discount_amount > 0 ? '- Rp' . number_format($order->discount_amount, 0, ',', '.') : '-'); ?>

    </strong>
</div>

<div class="status-summary-row">
    <span>Total Pesanan</span>
    <strong>Rp<?php echo e(number_format($order->grand_total, 0, ',', '.')); ?></strong>
</div>

<div class="status-summary-row">
    <span>Kode Unik</span>
    <strong>
        <?php echo e($uniqueCode > 0 ? 'Rp' . number_format($uniqueCode, 0, ',', '.') : '-'); ?>

    </strong>
</div>

<div class="status-summary-row">
    <span>Total Bayar</span>
    <strong>Rp<?php echo e(number_format($paymentAmount, 0, ',', '.')); ?></strong>
</div>

    <div style="background:#f8f8f8;border:1px solid #eee;border-radius:14px;padding:14px;margin-top:16px;line-height:1.7;">
        <?php if(($order->payment->method ?? '') === 'QRIS'): ?>
            <strong>Instruksi QRIS</strong><br>
            Scan QRIS pembayaran sesuai nominal:
            <strong>Rp<?php echo e(number_format($paymentAmount, 0, ',', '.')); ?></strong>
        <?php else: ?>
            <strong>Instruksi Pembayaran</strong><br>
            Transfer sesuai nominal unik:
            <strong>Rp<?php echo e(number_format($paymentAmount, 0, ',', '.')); ?></strong><br>
            Gunakan kode pembayaran:
            <strong><?php echo e($order->payment->transaction_ref ?? '-'); ?></strong>
        <?php endif; ?>
    </div>

   <?php if(($order->payment->status ?? 'pending') === 'paid'): ?>
    <div class="qr-refill-box">
        <div class="qr-refill-title">Pembayaran Berhasil</div>
        <p>QR refill sudah aktif dan dapat digunakan pada mesin SCENTCYCLE.</p>

        <div class="fake-refill-qr">
            <div class="fake-refill-qr-grid">
                <?php for($i = 1; $i <= 81; $i++): ?>
                    <span class="<?php echo e(in_array($i, [1,2,3,4,5,6,7,10,16,19,25,28,31,32,34,37,39,41,44,46,48,51,53,55,56,57,58,59,60,61,62,64,70,73,79,80,81]) ? 'dark' : ''); ?>"></span>
                <?php endfor; ?>
            </div>
        </div>

        <div class="qr-refill-code">
            Kode Refill:<br>
            <strong><?php echo e($order->order_code); ?></strong>
        </div>
    </div>
<?php else: ?>
    <div class="payment-waiting-box">
        Pembayaran belum terverifikasi. Admin perlu memvalidasi pembayaran berdasarkan nominal, kode unik, dan kode pembayaran.
    </div>

    <a href="<?php echo e(route('orders.refreshPayment', $order->order_code)); ?>"
   class="status-pay-btn"
   style="display:block;text-align:center;text-decoration:none;">
    Cek Status Pembayaran
</a>
<?php endif; ?>

</div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const reviewForms = document.querySelectorAll('.review-form');

    reviewForms.forEach(function (form) {
        const stars = form.querySelectorAll('input[name="rating"]');
        const commentWrap = form.querySelector('.review-comment-wrap');
        const ratingText = form.querySelector('.review-rating-text');
        const submitBtn = form.querySelector('.review-submit-btn');

        stars.forEach(function (star) {
            star.addEventListener('change', function () {
                if (commentWrap) {
                    commentWrap.classList.add('is-show');
                }

                if (submitBtn) {
                    submitBtn.classList.add('is-show');
                }

                if (ratingText) {
                    ratingText.textContent =
                        `Kamu memilih ${this.value} dari 5 bintang. Tambahkan komentar jika ingin.`;
                }
            });
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/status-pesanan.blade.php ENDPATH**/ ?>