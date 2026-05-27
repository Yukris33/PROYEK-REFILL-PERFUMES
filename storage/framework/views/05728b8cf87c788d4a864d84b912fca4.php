<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard - SCENTCYCLE'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<div class="admin-shell">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar__brand">
            <div class="admin-brand-mark">
                <i class="bi bi-grid-1x2-fill"></i>
            </div>

            <div>
                <strong>SCENTCYCLE</strong>
                <span>Admin Console</span>
            </div>
        </div>

        <div class="admin-sidebar__profile">
            <div class="admin-avatar">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </div>

            <div class="admin-profile-text">
                <strong><?php echo e(auth()->user()->name); ?></strong>
                <span><?php echo e(auth()->user()->email); ?></span>
                <small>Role: <?php echo e(auth()->user()->role); ?></small>
            </div>
        </div>

        <nav class="admin-menu">

            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="admin-menu__item <?php echo e(request()->routeIs('admin.dashboard') ? 'is-active' : ''); ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?php echo e(route('admin.orders.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.orders.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-bag-check"></i>
    <span>Pesanan & Pembayaran</span>
</a>

            <a href="<?php echo e(route('admin.reviews.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.reviews.*') ? 'is-active' : ''); ?>">
                <i class="bi bi-star-half"></i>
                <span>Rating & Ulasan</span>
            </a>

            <a href="<?php echo e(route('admin.vending.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.vending.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-cpu"></i>
    <span>Vending Machine</span>
</a>

<a href="<?php echo e(route('admin.recycle-bottles.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.recycle-bottles.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-recycle"></i>
    <span>Recycle Botol</span>
</a>

            <a href="<?php echo e(route('admin.vouchers.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.vouchers.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-ticket-perforated"></i>
    <span>Voucher & Poin</span>
</a>

            <a href="<?php echo e(route('admin.support-tickets.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.support-tickets.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-headset"></i>
    <span>Laporan Kendala</span>
</a>

<a href="<?php echo e(route('admin.partnerships.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.partnerships.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-handshake"></i>
    <span>Kerja Sama</span>
</a>

<a href="<?php echo e(route('admin.users.index')); ?>"
   class="admin-menu__item <?php echo e(request()->routeIs('admin.users.*') ? 'is-active' : ''); ?>">
    <i class="bi bi-people"></i>
    <span>Pengguna</span>
</a>
        </nav>

        <div class="admin-sidebar__bottom">
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="admin-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout Admin</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="admin-main">

        <!-- TOPBAR -->
        <header class="admin-topbar">
            <div>
                <p class="admin-topbar__eyebrow">SCENTCYCLE Management</p>
                <h1><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h1>
            </div>

            <div class="admin-topbar__meta">
                <div class="admin-pill">
                    <i class="bi bi-shield-check"></i>
                    Admin Access
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="admin-content">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>