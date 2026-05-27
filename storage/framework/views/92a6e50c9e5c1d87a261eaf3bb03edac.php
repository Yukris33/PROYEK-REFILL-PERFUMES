

<?php $__env->startSection('title', 'Kerja Sama - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Kerja Sama'); ?>

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
        <span>Total Request</span>
        <strong><?php echo e(number_format($totalRequests, 0, ',', '.')); ?></strong>
        <small>Semua permintaan kerja sama</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Baru</span>
        <strong><?php echo e(number_format($newRequests, 0, ',', '.')); ?></strong>
        <small>Belum ditinjau</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Ditinjau</span>
        <strong><?php echo e(number_format($reviewedRequests, 0, ',', '.')); ?></strong>
        <small>Sudah masuk review admin</small>
    </article>

    <article class="admin-module-kpi-card">
        <span>Dihubungi</span>
        <strong><?php echo e(number_format($contactedRequests, 0, ',', '.')); ?></strong>
        <small>Pengaju sudah di-follow up</small>
    </article>
</section>

<section class="admin-module-filter-card">
    <div class="admin-module-head">
        <div>
            <span>Filter Partnership</span>
            <h2>Kelola peluang kolaborasi SCENTCYCLE</h2>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('admin.partnerships.index')); ?>" class="admin-module-filter-form admin-module-filter-form--partnership">
        <div class="admin-module-field admin-module-field--search">
            <label>Cari Data</label>
            <input
                type="text"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="Nama, email, bisnis, nomor HP, atau isi pesan..."
            >
        </div>

        <div class="admin-module-field">
            <label>Status</label>
            <select name="status">
                <option value="">Semua</option>
                <option value="new" <?php echo e($status === 'new' ? 'selected' : ''); ?>>Baru</option>
                <option value="reviewed" <?php echo e($status === 'reviewed' ? 'selected' : ''); ?>>Ditinjau</option>
                <option value="contacted" <?php echo e($status === 'contacted' ? 'selected' : ''); ?>>Dihubungi</option>
                <option value="closed" <?php echo e($status === 'closed' ? 'selected' : ''); ?>>Ditutup</option>
            </select>
        </div>

        <div class="admin-module-filter-actions">
            <button type="submit" class="admin-module-btn admin-module-btn--primary">
                <i class="bi bi-funnel"></i>
                Terapkan
            </button>

            <a href="<?php echo e(route('admin.partnerships.index')); ?>" class="admin-module-btn admin-module-btn--ghost">
                Reset
            </a>
        </div>
    </form>
</section>

<section class="admin-module-table-card">
    <div class="admin-module-table-head">
        <div>
            <span>Collaboration Pipeline</span>
            <h2>Permintaan Kerja Sama Masuk</h2>
        </div>

        <div class="admin-module-pill">
            <?php echo e(number_format($partnerships->total(), 0, ',', '.')); ?> request
        </div>
    </div>

    <div class="admin-module-table-wrap">
        <table class="admin-module-table admin-module-table--partnership">
            <thead>
                <tr>
                    <th>Pengaju</th>
                    <th>Bisnis</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Update Status</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $partnerships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partnership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="admin-module-person">
                                <strong><?php echo e($partnership->name); ?></strong>
                                <span><?php echo e($partnership->email); ?></span>
                                <small><?php echo e($partnership->phone ?? '-'); ?></small>
                            </div>
                        </td>

                        <td>
                            <strong><?php echo e($partnership->business_name ?? '-'); ?></strong>
                        </td>

                        <td>
                            <div class="admin-module-message">
                                <?php echo e($partnership->message); ?>

                            </div>
                        </td>

                        <td>
                            <span class="admin-module-status admin-module-status--<?php echo e($partnership->status); ?>">
                                <?php if($partnership->status === 'new'): ?>
                                    Baru
                                <?php elseif($partnership->status === 'reviewed'): ?>
                                    Ditinjau
                                <?php elseif($partnership->status === 'contacted'): ?>
                                    Dihubungi
                                <?php else: ?>
                                    Ditutup
                                <?php endif; ?>
                            </span>
                        </td>

                        <td>
                            <?php echo e($partnership->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB
                        </td>

                        <td>
                            <form method="POST" action="<?php echo e(route('admin.partnerships.update-status', $partnership)); ?>" class="admin-module-inline-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <select name="status">
                                    <option value="new" <?php echo e($partnership->status === 'new' ? 'selected' : ''); ?>>Baru</option>
                                    <option value="reviewed" <?php echo e($partnership->status === 'reviewed' ? 'selected' : ''); ?>>Ditinjau</option>
                                    <option value="contacted" <?php echo e($partnership->status === 'contacted' ? 'selected' : ''); ?>>Dihubungi</option>
                                    <option value="closed" <?php echo e($partnership->status === 'closed' ? 'selected' : ''); ?>>Ditutup</option>
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
                                <i class="bi bi-handshake"></i>
                                <strong>Belum ada permintaan kerja sama.</strong>
                                <span>Pengajuan dari halaman customer akan muncul di sini.</span>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($partnerships->hasPages()): ?>
        <div class="admin-module-pagination">
            <?php echo e($partnerships->links()); ?>

        </div>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/partnerships/index.blade.php ENDPATH**/ ?>