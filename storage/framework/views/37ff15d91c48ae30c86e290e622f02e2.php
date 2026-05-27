

<?php $__env->startSection('title', 'Laporan Kendala - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Laporan Kendala'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="admin-module-alert admin-module-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
<?php endif; ?>

<section class="admin-module-kpi-grid">
    <article class="admin-module-kpi-card">
        <span>Total Laporan</span>
        <strong><?php echo e(number_format($totalTickets, 0, ',', '.')); ?></strong>
        <small>Semua tiket kendala masuk</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Baru</span>
        <strong><?php echo e(number_format($openTickets, 0, ',', '.')); ?></strong>
        <small>Belum diproses admin</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Diproses</span>
        <strong><?php echo e(number_format($inProgressTickets, 0, ',', '.')); ?></strong>
        <small>Sedang ditangani</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Selesai</span>
        <strong><?php echo e(number_format($resolvedTickets, 0, ',', '.')); ?></strong>
        <small>Laporan yang sudah resolved</small>
    </article>
</section>

<section class="admin-module-filter-card">
    <div class="admin-module-head">
        <div>
            <span>Filter Laporan</span>
            <h2>Pantau keluhan dan bantuan customer</h2>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('admin.support-tickets.index')); ?>" class="admin-module-filter-form">
        <div class="admin-module-field admin-module-field--search">
            <label>Cari Data</label>
            <input
                type="text"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="Nama user, email, subject, atau isi kendala..."
            >
        </div>

        <div class="admin-module-field">
            <label>Kategori</label>
            <select name="category">
                <option value="">Semua</option>
                <option value="mesin" <?php echo e($category === 'mesin' ? 'selected' : ''); ?>>Mesin</option>
                <option value="transaksi" <?php echo e($category === 'transaksi' ? 'selected' : ''); ?>>Transaksi</option>
                <option value="voucher" <?php echo e($category === 'voucher' ? 'selected' : ''); ?>>Voucher</option>
                <option value="lainnya" <?php echo e($category === 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
            </select>
        </div>

        <div class="admin-module-field">
            <label>Status</label>
            <select name="status">
                <option value="">Semua</option>
                <option value="open" <?php echo e($status === 'open' ? 'selected' : ''); ?>>Baru</option>
                <option value="in_progress" <?php echo e($status === 'in_progress' ? 'selected' : ''); ?>>Diproses</option>
                <option value="resolved" <?php echo e($status === 'resolved' ? 'selected' : ''); ?>>Selesai</option>
                <option value="closed" <?php echo e($status === 'closed' ? 'selected' : ''); ?>>Ditutup</option>
            </select>
        </div>

        <div class="admin-module-filter-actions">
            <button type="submit" class="admin-module-btn admin-module-btn--primary">
                <i class="bi bi-funnel"></i>
                Terapkan
            </button>

            <a href="<?php echo e(route('admin.support-tickets.index')); ?>" class="admin-module-btn admin-module-btn--ghost">
                Reset
            </a>
        </div>
    </form>
</section>

<section class="admin-module-table-card">
    <div class="admin-module-table-head">
        <div>
            <span>Customer Support</span>
            <h2>Daftar Laporan Kendala</h2>
        </div>

        <div class="admin-module-pill">
            <?php echo e(number_format($tickets->total(), 0, ',', '.')); ?> laporan
        </div>
    </div>

    <div class="admin-module-table-wrap">
        <table class="admin-module-table admin-module-table--support">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Kategori</th>
                    <th>Subject & Detail</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Update Status</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="admin-module-person">
                                <strong><?php echo e($ticket->user->name ?? 'Guest / Tidak Login'); ?></strong>
                                <span><?php echo e($ticket->user->email ?? '-'); ?></span>
                            </div>
                        </td>

                        <td>
                            <span class="admin-module-badge admin-module-badge--category">
                                <?php echo e(strtoupper($ticket->category)); ?>

                            </span>
                        </td>

                        <td>
                            <div class="admin-module-description">
                                <strong><?php echo e($ticket->subject); ?></strong>
                                <p><?php echo e($ticket->description); ?></p>
                            </div>
                        </td>

                        <td>
                            <span class="admin-module-status admin-module-status--<?php echo e($ticket->status); ?>">
                                <?php if($ticket->status === 'open'): ?>
                                    Baru
                                <?php elseif($ticket->status === 'in_progress'): ?>
                                    Diproses
                                <?php elseif($ticket->status === 'resolved'): ?>
                                    Selesai
                                <?php else: ?>
                                    Ditutup
                                <?php endif; ?>
                            </span>
                        </td>

                        <td>
                            <?php echo e($ticket->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB
                        </td>

                        <td>
                            <form method="POST" action="<?php echo e(route('admin.support-tickets.update-status', $ticket)); ?>" class="admin-module-inline-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <select name="status">
                                    <option value="open" <?php echo e($ticket->status === 'open' ? 'selected' : ''); ?>>Baru</option>
                                    <option value="in_progress" <?php echo e($ticket->status === 'in_progress' ? 'selected' : ''); ?>>Diproses</option>
                                    <option value="resolved" <?php echo e($ticket->status === 'resolved' ? 'selected' : ''); ?>>Selesai</option>
                                    <option value="closed" <?php echo e($ticket->status === 'closed' ? 'selected' : ''); ?>>Ditutup</option>
                                </select>

                                <button type="submit">
                                    Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">
                            <div class="admin-module-empty">
                                <i class="bi bi-headset"></i>
                                <strong>Belum ada laporan kendala.</strong>
                                <span>Data yang dikirim customer akan tampil di sini.</span>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($tickets->hasPages()): ?>
        <div class="admin-module-pagination">
            <?php echo e($tickets->links()); ?>

        </div>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/support-tickets/index.blade.php ENDPATH**/ ?>