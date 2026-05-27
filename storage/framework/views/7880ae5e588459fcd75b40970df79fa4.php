

<?php $__env->startSection('title', $bottle['name'] . ' - SCENTCYCLE'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/main.css?v=107')); ?>"></div>

<section class="preview-page" data-page="bottle-preview">
    <div class="preview-wrap">
        <div class="preview-grid">

            <div class="preview-media">
                <div class="preview-media-box">
                    <img src="<?php echo e(asset($bottle['image'])); ?>" alt="<?php echo e($bottle['name']); ?>">
                </div>
            </div>

            <div class="preview-info">
                <div class="preview-kicker"><?php echo e($bottle['kicker']); ?></div>
                <h1 class="preview-title"><?php echo e($bottle['name']); ?></h1>

                <?php if(session('error')): ?>
                    <div style="margin-bottom:16px; color:#991b1b;">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div style="margin-bottom:16px; color:#991b1b;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <p class="preview-desc">
                    <?php echo e($bottle['description']); ?>

                </p>

                <p class="preview-desc preview-desc--secondary">
                    <?php echo e($bottle['description2']); ?>

                </p>

                <div class="preview-notes">
                    <div class="preview-note-item">
                        <span class="label">Character</span>
                        <strong><?php echo e($bottle['character']); ?></strong>
                    </div>

                    <div class="preview-note-item">
                        <span class="label">Category</span>
                        <strong><?php echo e($bottle['type']); ?></strong>
                    </div>
                </div>

                <form action="<?php echo e(route('cart.add')); ?>" method="POST" id="addToCartForm">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="product_slug" value="<?php echo e($bottle['slug']); ?>">
                    <input type="hidden" name="product_name" value="<?php echo e($bottle['name']); ?>">
                    <input type="hidden" name="product_image" value="<?php echo e($bottle['image']); ?>">
                    <input type="hidden" name="product_brand" value="SCENTC">
                    <input type="hidden" name="product_category" value="bottle">
                    <input type="hidden" name="product_description" value="<?php echo e($bottle['description']); ?>">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" id="cartPriceInput">

                    <div class="preview-size-block">
                        <label for="sizeSelect" class="preview-size-label">Pilih Ukuran</label>

                        <div class="preview-select-wrap">
                            <select id="sizeSelect" name="size" class="preview-select" required>
                                <option value="">-- Pilih ukuran ml --</option>

                                <?php $__currentLoopData = $bottle['sizes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size => $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($size); ?>" data-price="<?php echo e($price); ?>">
                                        <?php echo e($size); ?> ml
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="preview-branch-block">
                        <label class="preview-branch-label">Pilih Cabang Mesin</label>

                        <input type="hidden" name="branch_location" id="branchLocationInput" value="UMN">

                        <div class="preview-branch-options">
                            <button type="button" class="preview-branch-btn is-active" data-branch="UMN">
                                <span class="branch-flag">🏫</span>
                                <span>UMN</span>
                            </button>

                            <button type="button" class="preview-branch-btn" data-branch="Summarecon Mall Serpong">
                                <span class="branch-flag">🛍️</span>
                                <span>SMS</span>
                            </button>

                            <button type="button" class="preview-branch-btn" data-branch="AEON Mall BSD">
                                <span class="branch-flag">🇯🇵</span>
                                <span>AEON BSD</span>
                            </button>
                        </div>

                        <div class="preview-branch-detail" id="branchDetailText">
                            Mesin dipilih: <strong>UMN</strong> — Jl. Scientia Boulevard, Gading Serpong.
                        </div>
                    </div>

                    <div class="preview-price-box">
                        <span class="preview-price-label">Harga</span>
                        <div class="preview-price-value" id="priceText">Pilih ukuran dulu</div>
                    </div>

                    <div class="preview-actions">
                        <a href="<?php echo e(route('products.botol')); ?>" class="preview-btn preview-btn--ghost">
                            Kembali
                        </a>

                        <button type="submit" class="preview-btn preview-btn--cart">
                            Masukkan Keranjang
                        </button>

                        <button
                            type="submit"
                            class="preview-btn preview-btn--primary"
                            name="buy_now"
                            value="1"
                        >
                            Beli Sekarang
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sizeSelect = document.getElementById('sizeSelect');
    const priceText = document.getElementById('priceText');
    const cartPriceInput = document.getElementById('cartPriceInput');
    const addToCartForm = document.getElementById('addToCartForm');

    const branchButtons = document.querySelectorAll('.preview-branch-btn');
    const branchLocationInput = document.getElementById('branchLocationInput');
    const branchDetailText = document.getElementById('branchDetailText');

    const branchDetails = {
        'UMN': 'Mesin dipilih: <strong>UMN</strong> — Jl. Scientia Boulevard, Gading Serpong.',
        'Summarecon Mall Serpong': 'Mesin dipilih: <strong>SMS</strong> — Summarecon Mall Serpong, Gading Serpong.',
        'AEON Mall BSD': 'Mesin dipilih: <strong>AEON BSD</strong> — AEON Mall BSD City, Tangerang Selatan.'
    };

    function formatRupiah(value) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(Number(value));
    }

    function updatePrice() {
        if (!sizeSelect || !priceText || !cartPriceInput) return;

        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
        const price = selectedOption ? selectedOption.getAttribute('data-price') : '';

        if (sizeSelect.value && price) {
            priceText.textContent = formatRupiah(price);
            cartPriceInput.value = price;
        } else {
            priceText.textContent = 'Pilih ukuran dulu';
            cartPriceInput.value = '';
        }
    }

    if (sizeSelect) {
        sizeSelect.addEventListener('change', updatePrice);
        updatePrice();
    }

    branchButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            branchButtons.forEach(function (item) {
                item.classList.remove('is-active');
            });

            this.classList.add('is-active');

            const branch = this.dataset.branch;
            branchLocationInput.value = branch;
            branchDetailText.innerHTML = branchDetails[branch] || branch;
        });
    });

    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function (e) {
            updatePrice();

            if (!sizeSelect.value || !cartPriceInput.value) {
                e.preventDefault();
                alert('Pilih ukuran dulu sebelum melanjutkan.');
                return;
            }

            if (!branchLocationInput.value) {
                e.preventDefault();
                alert('Pilih cabang mesin dulu sebelum melanjutkan.');
            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/preview/bottle.blade.php ENDPATH**/ ?>