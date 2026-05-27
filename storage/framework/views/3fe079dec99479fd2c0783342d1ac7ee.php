

<?php $__env->startSection('title', 'Pengguna - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Pengguna'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="admin-user-alert admin-user-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="admin-user-alert admin-user-alert--error">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Gagal</strong>
            <span><?php echo e(session('error')); ?></span>
        </div>
    </div>
<?php endif; ?>



<section class="admin-user-kpi-grid">

    <article class="admin-user-kpi-card">
        <span>Total Pengguna</span>
        <strong><?php echo e(number_format($totalUsers, 0, ',', '.')); ?></strong>
        <small>Seluruh akun terdaftar</small>
    </article>

    <article class="admin-user-kpi-card">
        <span>Total Customer</span>
        <strong><?php echo e(number_format($totalCustomers, 0, ',', '.')); ?></strong>
        <small>Akun dengan role user</small>
    </article>

    <article class="admin-user-kpi-card">
        <span>Total Admin</span>
        <strong><?php echo e(number_format($totalAdmins, 0, ',', '.')); ?></strong>
        <small>Akun pengelola sistem</small>
    </article>

    <article class="admin-user-kpi-card">
        <span>Total Poin User</span>
        <strong><?php echo e(number_format($totalPoints, 0, ',', '.')); ?></strong>
        <small>Akumulasi poin semua akun</small>
    </article>

</section>



<section class="admin-user-filter-card">
    <div class="admin-user-head">
        <div>
            <span>User Monitoring</span>
            <h2>Kelola dan pantau akun SCENTCYCLE</h2>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="admin-user-filter-form">

        <div class="admin-user-field admin-user-field--search">
            <label for="search">Cari Pengguna</label>
            <input
                type="text"
                id="search"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="Cari nama, email, atau nomor telepon..."
            >
        </div>

        <div class="admin-user-field">
            <label for="role">Filter Role</label>
            <select name="role" id="role">
                <option value="">Semua Role</option>
                <option value="user" <?php echo e($role === 'user' ? 'selected' : ''); ?>>User</option>
                <option value="admin" <?php echo e($role === 'admin' ? 'selected' : ''); ?>>Admin</option>
            </select>
        </div>

        <div class="admin-user-filter-actions">
            <button type="submit" class="admin-user-btn admin-user-btn--primary">
                <i class="bi bi-funnel"></i>
                Terapkan Filter
            </button>

            <a href="<?php echo e(route('admin.users.index')); ?>" class="admin-user-btn admin-user-btn--ghost">
                Reset
            </a>
        </div>

    </form>
</section>



<section class="admin-user-table-card">

    <div class="admin-user-table-head">
        <div>
            <span>Account Directory</span>
            <h2>Daftar Pengguna</h2>
        </div>

        <div class="admin-user-pill">
            <?php echo e(number_format($users->total(), 0, ',', '.')); ?> akun
        </div>
    </div>

    <div class="admin-user-table-wrap">
        <table class="admin-user-table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Role</th>
                    <th>Saldo Poin</th>
                    <th>Ringkasan Aktivitas</th>
                    <th>Tanggal Daftar</th>
                    <th>Ubah Role</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>

                        <td>
                            <div class="admin-user-profile-cell">
                                <div class="admin-user-avatar">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>

                                <div>
                                    <strong><?php echo e($user->name); ?></strong>
                                    <span><?php echo e($user->email); ?></span>
                                    <small><?php echo e($user->phone ?? '-'); ?></small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="admin-user-role admin-user-role--<?php echo e($user->role); ?>">
                                <?php echo e(strtoupper($user->role)); ?>

                            </span>
                        </td>

                        <td>
                            <strong class="admin-user-points">
                                <?php echo e(number_format($user->points_balance, 0, ',', '.')); ?>

                            </strong>
                        </td>

                        <td>
                            <div class="admin-user-activity-pills">
                                <span>Order <b><?php echo e($user->orders_count); ?></b></span>
                                <span>Review <b><?php echo e($user->reviews_count); ?></b></span>
                                <span>Voucher <b><?php echo e($user->user_vouchers_count); ?></b></span>
                                <span>Kendala <b><?php echo e($user->support_tickets_count); ?></b></span>
                            </div>
                        </td>

                        <td>
                            <?php echo e($user->created_at?->timezone('Asia/Jakarta')->format('d M Y')); ?>

                        </td>

                        <td>
                            <form method="POST"
                                  action="<?php echo e(route('admin.users.update-role', $user)); ?>"
                                  class="admin-user-role-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>

                                <select name="role">
                                    <option value="user" <?php echo e($user->role === 'user' ? 'selected' : ''); ?>>
                                        User
                                    </option>
                                    <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>
                                        Admin
                                    </option>
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
                            <div class="admin-user-empty">
                                <i class="bi bi-people"></i>
                                <strong>Tidak ada pengguna yang ditemukan.</strong>
                                <span>Coba ubah kata kunci pencarian atau filter role.</span>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($users->hasPages()): ?>
        <div class="admin-user-pagination">
            <?php echo e($users->links()); ?>

        </div>
    <?php endif; ?>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/users/index.blade.php ENDPATH**/ ?>