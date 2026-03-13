<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Auth | Perfume Store'); ?></title>

    <link rel="stylesheet" href="<?php echo e(asset('css/auth.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-topbar">
            <div class="auth-flags">
                <img src="https://flagcdn.com/w40/id.png" alt="ID">
                <img src="https://flagcdn.com/w40/gb.png" alt="EN">
            </div>

            <div class="auth-back">
             <a href="<?php echo e(url('/')); ?>" class="back-home">
                ← Back to Home
            </a>
        </div>

            <a href="<?php echo e(route('home')); ?>" class="auth-brand">PERFUME STORE</a>

            <div class="auth-topbar-right">
                <a href="<?php echo e(route('cart.index')); ?>" class="auth-icon">
                    <i class="bi bi-bag"></i>
                    <span>(<?php echo e(count(session('cart', []))); ?>)</span>
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="flash flash-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('status')): ?>
            <div class="flash flash-success"><?php echo e(session('status')); ?></div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/layouts/auth.blade.php ENDPATH**/ ?>