

<?php $__env->startSection('title', 'Register | Perfume Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-visual auth-visual-register">
        <div class="auth-copy">
            <p class="auth-kicker">New member</p>
            <h1>Create Your Account</h1>
            <p>
                Join sekarang buat dapetin diskon member, checkout lebih cepat,
                dan reward points setiap pembelian.
            </p>
        </div>

        <div class="auth-bottles">
            <img src="<?php echo e(asset('img/b7.png')); ?>" alt="Bottle">
            <img src="<?php echo e(asset('img/silver2.png')); ?>" alt="Silver Bottle">
        </div>
    </div>

    <div class="auth-card">
        <div class="auth-tabs">
            <a href="<?php echo e(route('login')); ?>">Login</a>
            <a href="<?php echo e(route('register')); ?>" class="active">Register</a>
            <a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
        </div>

        <div class="auth-card-grid">
            <div>
                <h2>Register</h2>

                <form method="POST" action="<?php echo e(route('register.submit')); ?>" class="auth-form">
                    <?php echo csrf_field(); ?>

                    <label>Full Name</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Your full name" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="error-text"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="name@example.com" required>
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

                    <label>Phone Number</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="08xxxxxxxxxx">
                    <?php $__errorArgs = ['phone'];
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
                    <input type="password" name="password" placeholder="Minimum 8 characters" required>
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

                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Repeat password" required>

                    <label class="check-row">
                        <input type="checkbox" required>
                        <span>I agree to the Terms & Conditions</span>
                    </label>

                    <button type="submit" class="btn-auth">Register</button>

                    <p class="switch-text">
                        Already have an account?
                        <a href="<?php echo e(route('login')); ?>">Login</a>
                    </p>
                </form>
            </div>

            <aside class="auth-sidebox">
                <h3>Why Join Perfume Store?</h3>
                <ul>
                    <li>Member exclusive discount</li>
                    <li>Faster checkout</li>
                    <li>Reward points tiap pembelian</li>
                    <li>Voucher dan benefit berikutnya</li>
                </ul>
            </aside>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/auth/register.blade.php ENDPATH**/ ?>