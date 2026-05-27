

<?php $__env->startSection('title', 'Recycle Botol - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Recycle Botol'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="admin-recycle-alert admin-recycle-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="admin-recycle-alert admin-recycle-alert--error">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Proses belum valid</strong>
            <span>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </div>
    </div>
<?php endif; ?>



<section class="admin-recycle-kpi-grid">

    <article class="admin-recycle-kpi-card">
        <span>Menunggu Recycle</span>
        <strong><?php echo e(number_format($totalWaitingBottles, 0, ',', '.')); ?></strong>
        <small>Botol return yang belum diproses</small>
    </article>

    <article class="admin-recycle-kpi-card">
        <span>Sudah Diproses</span>
        <strong><?php echo e(number_format($totalProcessedBottles, 0, ',', '.')); ?></strong>
        <small>Botol menjadi stok higienis</small>
    </article>

    <article class="admin-recycle-kpi-card">
        <span>Total Batch</span>
        <strong><?php echo e(number_format($totalRecycleBatches, 0, ',', '.')); ?></strong>
        <small>Batch hasil collect dari vending</small>
    </article>

    <article class="admin-recycle-kpi-card">
        <span>Nilai Stok Recycle</span>
        <strong>Rp<?php echo e(number_format($totalInventoryValue, 0, ',', '.')); ?></strong>
        <small>Estimasi nilai jual botol hasil recycle</small>
    </article>

</section>



<section class="admin-recycle-main-grid">

    <article class="admin-recycle-story-card">
        <span>Circular Bottle Flow</span>
        <h2>Botol return diproses menjadi stok siap jual</h2>
        <p>
            Setiap botol return yang telah di-collect dari vending machine masuk ke recycle batch.
            Admin kemudian memilih hasil akhir botol, ukuran, dan jumlah yang diproses.
        </p>

        <div class="admin-recycle-flow">
            <div>
                <i class="bi bi-recycle"></i>
                <strong>Return</strong>
                <small>Botol dikumpulkan customer</small>
            </div>

            <i class="bi bi-arrow-right"></i>

            <div>
                <i class="bi bi-box-arrow-in-down"></i>
                <strong>Collect</strong>
                <small>Admin ambil dari mesin</small>
            </div>

            <i class="bi bi-arrow-right"></i>

            <div>
                <i class="bi bi-stars"></i>
                <strong>Recycle</strong>
                <small>Jadi botol higienis</small>
            </div>

            <i class="bi bi-arrow-right"></i>

            <div>
                <i class="bi bi-shop"></i>
                <strong>Ready Sell</strong>
                <small>Masuk stok produk botol</small>
            </div>
        </div>
    </article>


    <article class="admin-recycle-form-card">
        <div class="admin-recycle-card-head">
            <span>Recycle Processor</span>
            <h2>Proses Botol Return</h2>
        </div>

        <form method="POST" action="<?php echo e(route('admin.recycle-bottles.process')); ?>" class="admin-recycle-form">
            <?php echo csrf_field(); ?>

            <label>
                Batch Collect
                <select name="batch_id" required>
                    <option value="">Pilih batch return</option>

                    <?php $__currentLoopData = $pendingBatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($batch->id); ?>" <?php echo e(old('batch_id') == $batch->id ? 'selected' : ''); ?>>
                            Batch #<?php echo e($batch->id); ?>

                            · <?php echo e($batch->machine->machine_name ?? '-'); ?>

                            · sisa <?php echo e($batch->remaining_quantity); ?> botol
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>

            <label>
                Produk & Ukuran Botol Tujuan
                <select name="product_variant_id" id="recycleVariantSelect" required>
                    <option value="">Pilih varian botol</option>

                    <?php $__currentLoopData = $bottleProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($variant->id); ?>"
                                data-price="<?php echo e($variant->price); ?>"
                                data-product="<?php echo e($product->name); ?>"
                                data-size="<?php echo e($variant->size_ml); ?>"
                                <?php echo e(old('product_variant_id') == $variant->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($product->name); ?> · <?php echo e($variant->size_ml); ?>ml
                                · Rp<?php echo e(number_format($variant->price, 0, ',', '.')); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>

            <label>
                Jumlah Botol Diproses
                <input
                    type="number"
                    name="processed_quantity"
                    min="1"
                    value="<?php echo e(old('processed_quantity')); ?>"
                    required
                    placeholder="Contoh: 10"
                >
            </label>

            <div class="admin-recycle-price-preview" id="recyclePricePreview">
                <span>Harga jual per botol</span>
                <strong>Pilih varian botol dulu</strong>
            </div>

            <label>
                Catatan Proses
                <textarea
                    name="note"
                    rows="4"
                    placeholder="Contoh: Sudah dibersihkan, disterilisasi, dan lolos quality check."
                ><?php echo e(old('note')); ?></textarea>
            </label>

            <button type="submit">
                <i class="bi bi-recycle"></i>
                Proses Recycle Botol
            </button>
        </form>
    </article>

</section>



<section class="admin-recycle-table-card">
    <div class="admin-recycle-table-head">
        <div>
            <span>Return Batch Queue</span>
            <h2>Antrian Botol Return</h2>
        </div>
    </div>

    <div class="admin-recycle-table-wrap">
        <table class="admin-recycle-table">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Mesin Asal</th>
                    <th>Collected</th>
                    <th>Sisa</th>
                    <th>Status</th>
                    <th>Waktu Collect</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <strong>#<?php echo e($batch->id); ?></strong>
                        </td>

                        <td>
                            <?php echo e($batch->machine->machine_name ?? '-'); ?>

                        </td>

                        <td>
                            <?php echo e(number_format($batch->collected_quantity, 0, ',', '.')); ?> botol
                        </td>

                        <td>
                            <?php echo e(number_format($batch->remaining_quantity, 0, ',', '.')); ?> botol
                        </td>

                        <td>
                            <span class="admin-recycle-status admin-recycle-status--<?php echo e($batch->status); ?>">
                                <?php echo e(strtoupper($batch->status)); ?>

                            </span>
                        </td>

                        <td>
                            <?php echo e($batch->collected_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-'); ?> WIB
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">
                            <div class="admin-recycle-empty">
                                Belum ada batch return dari vending machine.
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>



<section class="admin-recycle-table-card">
    <div class="admin-recycle-table-head">
        <div>
            <span>Recycle History</span>
            <h2>Riwayat Botol yang Sudah Diproses</h2>
        </div>
    </div>

    <div class="admin-recycle-table-wrap">
        <table class="admin-recycle-table">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Hasil Botol</th>
                    <th>Jumlah</th>
                    <th>Harga / Botol</th>
                    <th>Nilai Stok</th>
                    <th>Diproses Pada</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $processes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            #<?php echo e($process->batch_id); ?>

                        </td>

                        <td>
                            <strong><?php echo e($process->product->name ?? '-'); ?></strong><br>
                            <small><?php echo e($process->variant->size_ml ?? '-'); ?>ml</small>
                        </td>

                        <td>
                            <?php echo e(number_format($process->processed_quantity, 0, ',', '.')); ?>

                        </td>

                        <td>
                            Rp<?php echo e(number_format($process->selling_price_per_bottle, 0, ',', '.')); ?>

                        </td>

                        <td>
                            Rp<?php echo e(number_format($process->total_inventory_value, 0, ',', '.')); ?>

                        </td>

                        <td>
                            <?php echo e($process->processed_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-'); ?> WIB
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">
                            <div class="admin-recycle-empty">
                                Belum ada proses recycle yang tercatat.
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const variantSelect = document.getElementById('recycleVariantSelect');
    const pricePreview = document.getElementById('recyclePricePreview');

    function updateRecyclePricePreview() {
        if (!variantSelect || !pricePreview) return;

        const selected = variantSelect.options[variantSelect.selectedIndex];

        if (!selected || !selected.value) {
            pricePreview.innerHTML = `
                <span>Harga jual per botol</span>
                <strong>Pilih varian botol dulu</strong>
            `;
            return;
        }

        const price = Number(selected.dataset.price || 0);
        const product = selected.dataset.product || 'Botol';
        const size = selected.dataset.size || '-';

        pricePreview.innerHTML = `
            <span>Harga jual per botol</span>
            <strong>Rp${new Intl.NumberFormat('id-ID').format(price)}</strong>
            <small>${product} · ${size}ml</small>
        `;
    }

    variantSelect?.addEventListener('change', updateRecyclePricePreview);
    updateRecyclePricePreview();
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/recycle-bottles/index.blade.php ENDPATH**/ ?>