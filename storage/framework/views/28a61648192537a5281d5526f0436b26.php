

<?php $__env->startSection('title', 'Detail Pesanan - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Detail Pesanan'); ?>

<?php $__env->startSection('content'); ?>

    <section class="admin-order-detail-hero">
        <div>
            <span class="admin-order-detail-eyebrow">Order Detail</span>
            <h2><?php echo e($order->order_code); ?></h2>
            <p>
                Dibuat pada
                <?php echo e($order->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB
            </p>
        </div>

        <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-order-back-btn">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Pesanan
        </a>
    </section>

    <section class="admin-order-detail-grid">

        <article class="admin-order-detail-card">
    <div class="admin-order-detail-card__head">
        <span>Status Monitoring</span>
        <h3>Kelola Status</h3>
    </div>

    <?php if(session('success')): ?>
        <div class="admin-order-update-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>

    <div class="admin-order-status-stack admin-order-status-stack--current">
        <div>
            <span>Status Order Saat Ini</span>
            <strong class="admin-order-badge admin-order-badge--<?php echo e($order->status); ?>">
                <?php echo e(ucfirst($order->status)); ?>

            </strong>
        </div>

        <div>
            <span>Status Pembayaran Saat Ini</span>
            <strong class="admin-payment-badge admin-payment-badge--<?php echo e($order->payment_status); ?>">
                <?php echo e(ucfirst($order->payment_status)); ?>

            </strong>
        </div>
    </div>

    <form
        action="<?php echo e(route('admin.orders.update-status', $order)); ?>"
        method="POST"
        class="admin-order-status-form"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="admin-order-status-field">
            <label for="status">Ubah Status Pesanan</label>
            <select name="status" id="status" required>
                <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>
                    Pending
                </option>
                <option value="processing" <?php echo e($order->status === 'processing' ? 'selected' : ''); ?>>
                    Processing
                </option>
                <option value="completed" <?php echo e($order->status === 'completed' ? 'selected' : ''); ?>>
                    Completed
                </option>
                <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>
                    Cancelled
                </option>
            </select>
            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="admin-form-error"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="admin-order-status-field">
            <label for="payment_status">Ubah Status Pembayaran</label>
            <select name="payment_status" id="payment_status" required>
                <option value="unpaid" <?php echo e($order->payment_status === 'unpaid' ? 'selected' : ''); ?>>
                    Unpaid
                </option>
                <option value="paid" <?php echo e($order->payment_status === 'paid' ? 'selected' : ''); ?>>
                    Paid
                </option>
                <option value="failed" <?php echo e($order->payment_status === 'failed' ? 'selected' : ''); ?>>
                    Failed
                </option>
                <option value="refunded" <?php echo e($order->payment_status === 'refunded' ? 'selected' : ''); ?>>
                    Refunded
                </option>
            </select>
            <?php $__errorArgs = ['payment_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="admin-form-error"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="admin-order-update-btn">
            <i class="bi bi-save"></i>
            Simpan Perubahan
        </button>
    </form>
</article>

        <article class="admin-order-detail-card">
            <div class="admin-order-detail-card__head">
                <span>Status Monitoring</span>
                <h3>Status Pesanan</h3>
            </div>

            <div class="admin-order-status-stack">
                <div>
                    <span>Status Order</span>
                    <strong class="admin-order-badge admin-order-badge--<?php echo e($order->status); ?>">
                        <?php echo e(ucfirst($order->status)); ?>

                    </strong>
                </div>

                <div>
                    <span>Status Pembayaran</span>
                    <strong class="admin-payment-badge admin-payment-badge--<?php echo e($order->payment_status); ?>">
                        <?php echo e(ucfirst($order->payment_status)); ?>

                    </strong>
                </div>
            </div>
        </article>

        <article class="admin-order-detail-card">
            <div class="admin-order-detail-card__head">
                <span>Payment Summary</span>
                <h3>Rincian Pembayaran</h3>
            </div>

            <div class="admin-order-detail-list">
                <div>
                    <span>Metode Pembayaran</span>
                    <strong><?php echo e($order->payment->method ?? '-'); ?></strong>
                </div>

                <div>
                    <span>Subtotal</span>
                    <strong>Rp<?php echo e(number_format($order->subtotal ?? 0, 0, ',', '.')); ?></strong>
                </div>

                <div>
                    <span>Kode Unik</span>
                    <strong>Rp<?php echo e(number_format($order->unique_code ?? 0, 0, ',', '.')); ?></strong>
                </div>

                <div>
                    <span>Total Bayar</span>
                    <strong>Rp<?php echo e(number_format($order->grand_total ?? 0, 0, ',', '.')); ?></strong>
                </div>
            </div>
        </article>

    </section>

    <section class="admin-order-items-card">
        <div class="admin-order-table-head">
            <div>
                <span>Item Pesanan</span>
                <h2>Produk yang Dibeli</h2>
            </div>
        </div>

        <div class="admin-order-table-wrap">
            <table class="admin-order-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($item->product_name_snapshot); ?></strong>
                            </td>

                            <td>
                                <?php echo e($item->size_snapshot ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($item->qty); ?>

                            </td>

                            <td>
                                Rp<?php echo e(number_format($item->price, 0, ',', '.')); ?>

                            </td>

                            <td>
                                <strong>Rp<?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></strong>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="admin-order-empty">
                                    <i class="bi bi-box-seam"></i>
                                    <strong>Tidak ada item pesanan.</strong>
                                    <span>Data item belum tersedia.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>