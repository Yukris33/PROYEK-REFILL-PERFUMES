

<?php $__env->startSection('title', 'Login | Perfume Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-visual auth-visual-login">
        <div class="auth-copy">
            <p class="auth-kicker">Member access</p>
            <h1>Login &amp; Register</h1>
            <p>
                Welcome back. Masuk ke akun kamu untuk lanjut belanja, cek poin,
                dan simpan progress checkout.
            </p>
        </div>

        <div class="auth-bottles">
            <img src="<?php echo e(asset('img/ocean breeze fix.png')); ?>" alt="Ocean Breeze">
            <img src="<?php echo e(asset('img/velvet1.png')); ?>" alt="Velvet">
        </div>
    </div>

    <div class="auth-card">
        <div class="auth-tabs">
            <a href="<?php echo e(route('login')); ?>" class="active">Login</a>
            <a href="<?php echo e(route('register')); ?>">Register</a>
            <a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
        </div>

        <div class="auth-card-grid">
            <div>
                <h2>Login</h2>

                <form method="POST" action="<?php echo e(route('login.submit')); ?>" class="auth-form">
                    <?php echo csrf_field(); ?>

                    <label>Email Address</label>
                    <div class="input-wrap">
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="name@example.com" required>
                        <i class="bi bi-person"></i>
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="error-text"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <label>Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" placeholder="••••••••" required>
                        <i class="bi bi-lock"></i>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="error-text"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <label class="check-row">
                        <input type="checkbox" name="remember">
                        <span>Remember Me</span>
                    </label>

                    <button type="submit" class="btn-auth">Login</button>

                    <p class="switch-text">
                        Don’t have an account?
                        <a href="<?php echo e(route('register')); ?>">Create Account</a>
                    </p>

                    <p class="switch-text">
                        Forgot your password?
                        <a href="<?php echo e(route('password.request')); ?>">Reset here</a>
                    </p>
                </form>
            </div>

            <aside class="auth-sidebox dark">
    <div class="shield-icon"><i class="bi bi-shield-lock"></i></div>
    <h3>Login as Admin</h3>

    <form action="<?php echo e(route('admin.login.submit')); ?>" method="POST" class="auth-form admin-form">
    <?php echo csrf_field(); ?>

    <label>Email Admin</label>
    <div class="input-wrap">
        <input
            type="email"
            name="admin_email"
            value="<?php echo e(old('admin_email')); ?>"
            placeholder="admin@example.com"
            required
        >
        <i class="bi bi-person-badge"></i>
    </div>
    <?php $__errorArgs = ['admin_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="error-text"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label>Password</label>
    <div class="input-wrap">
        <input
            type="password"
            name="admin_password"
            placeholder="••••••••"
            required
        >
        <i class="bi bi-lock"></i>
    </div>
    <?php $__errorArgs = ['admin_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="error-text"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <button type="submit" class="btn-auth btn-admin">
        Admin Login
    </button>
</form>
</aside>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/auth/login.blade.php ENDPATH**/ ?>