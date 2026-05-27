

<?php $__env->startSection('title', 'Pesanan & Pembayaran - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Pesanan & Pembayaran'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="admin-order-kpi-grid">

        <article class="admin-order-kpi-card">
            <span>Total Pesanan</span>
            <strong><?php echo e(number_format($totalOrders, 0, ',', '.')); ?></strong>
            <small>Seluruh order yang tercatat</small>
        </article>

        <article class="admin-order-kpi-card admin-order-kpi-card--success">
            <span>Pembayaran Paid</span>
            <strong><?php echo e(number_format($paidOrders, 0, ',', '.')); ?></strong>
            <small>Order yang sudah dibayar</small>
        </article>

        <article class="admin-order-kpi-card admin-order-kpi-card--warning">
            <span>Belum Dibayar</span>
            <strong><?php echo e(number_format($unpaidOrders, 0, ',', '.')); ?></strong>
            <small>Order dengan status unpaid</small>
        </article>

        <article class="admin-order-kpi-card admin-order-kpi-card--revenue">
            <span>Total Revenue</span>
            <strong>Rp<?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></strong>
            <small>Dari payment berstatus paid</small>
        </article>

    </section>


    
    <section class="admin-order-filter-card">
        <div class="admin-order-filter-head">
            <div>
                <span>Filter Transaksi</span>
                <h2>Cari dan pantau pesanan customer</h2>
            </div>
        </div>

        <form method="GET" action="<?php echo e(route('admin.orders.index')); ?>" class="admin-order-filter-form">

            <div class="admin-order-filter-field admin-order-filter-field--search">
                <label for="search">Cari Pesanan</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    value="<?php echo e($search); ?>"
                    placeholder="Kode transaksi, nama customer, atau email..."
                >
            </div>

            <div class="admin-order-filter-field">
                <label for="order_status">Status Pesanan</label>
                <select name="order_status" id="order_status">
                    <option value="">Semua</option>
                    <option value="pending" <?php echo e($orderStatus === 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="paid" <?php echo e($orderStatus === 'paid' ? 'selected' : ''); ?>>Paid</option>
                    <option value="processing" <?php echo e($orderStatus === 'processing' ? 'selected' : ''); ?>>Processing</option>
                    <option value="completed" <?php echo e($orderStatus === 'completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="cancelled" <?php echo e($orderStatus === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>

            <div class="admin-order-filter-field">
                <label for="payment_status">Status Pembayaran</label>
                <select name="payment_status" id="payment_status">
                    <option value="">Semua</option>
                    <option value="unpaid" <?php echo e($paymentStatus === 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                    <option value="paid" <?php echo e($paymentStatus === 'paid' ? 'selected' : ''); ?>>Paid</option>
                    <option value="failed" <?php echo e($paymentStatus === 'failed' ? 'selected' : ''); ?>>Failed</option>
                    <option value="refunded" <?php echo e($paymentStatus === 'refunded' ? 'selected' : ''); ?>>Refunded</option>
                </select>
            </div>

            <div class="admin-order-filter-field">
                <label for="payment_method">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method">
                    <option value="">Semua</option>
                    <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($method); ?>" <?php echo e($paymentMethod === $method ? 'selected' : ''); ?>>
                            <?php echo e($method); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="admin-order-filter-actions">
                <button type="submit" class="admin-order-btn admin-order-btn--primary">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>

                <a href="<?php echo e(route('admin.orders.index')); ?>" class="admin-order-btn admin-order-btn--ghost">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </div>

        </form>
    </section>


    
    <section class="admin-order-table-card">
        <div class="admin-order-table-head">
            <div>
                <span>Daftar Transaksi</span>
                <h2>Pesanan & Pembayaran Customer</h2>
            </div>

            <div class="admin-order-result-pill">
                <?php echo e(number_format($orders->total(), 0, ',', '.')); ?> data ditemukan
            </div>
        </div>

        <div class="admin-order-table-wrap">
            <table class="admin-order-table">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status Pesanan</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($order->order_code); ?></strong>
                            </td>

                            <td>
                                <div class="admin-order-customer">
                                    <strong><?php echo e($order->customer_name ?? $order->user->name ?? 'Guest'); ?></strong>
                                    <span><?php echo e($order->customer_email ?? $order->user->email ?? '-'); ?></span>
                                </div>
                            </td>

                            <td>
                                <?php echo e($order->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB
                            </td>

                            <td>
                                <strong>Rp<?php echo e(number_format($order->grand_total, 0, ',', '.')); ?></strong>
                            </td>

                            <td>
                                <?php echo e($order->payment->method ?? '-'); ?>

                            </td>

                            <td>
                                <span class="admin-order-badge admin-order-badge--<?php echo e($order->status); ?>">
                                    <?php echo e(ucfirst($order->status)); ?>

                                </span>
                            </td>

                            <td>
                                <span class="admin-payment-badge admin-payment-badge--<?php echo e($order->payment_status); ?>">
                                    <?php echo e(ucfirst($order->payment_status)); ?>

                                </span>
                            </td>

                            <td>
                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="admin-order-detail-btn">
                                    <i class="bi bi-eye"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8">
                                <div class="admin-order-empty">
                                    <i class="bi bi-inbox"></i>
                                    <strong>Belum ada data yang sesuai.</strong>
                                    <span>Coba ubah filter atau reset pencarian.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($orders->hasPages()): ?>
            <div class="admin-order-pagination">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>