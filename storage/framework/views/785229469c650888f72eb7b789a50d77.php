

<?php $__env->startSection('title', 'Voucher & Poin - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Voucher & Poin'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="admin-voucher-alert admin-voucher-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="admin-voucher-alert admin-voucher-alert--error">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Form belum valid</strong>
            <span>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </div>
    </div>
<?php endif; ?>

    
    <section class="admin-voucher-kpi-grid">

        <article class="admin-voucher-kpi-card admin-voucher-kpi-card--points">
            <span>Total Poin Customer</span>
            <strong><?php echo e(number_format($totalCustomerPoints, 0, ',', '.')); ?></strong>
            <small>Akumulasi saldo poin seluruh customer</small>
        </article>

        <article class="admin-voucher-kpi-card admin-voucher-kpi-card--claim">
            <span>Voucher Diklaim</span>
            <strong><?php echo e(number_format($totalClaimedVouchers, 0, ',', '.')); ?></strong>
            <small>Total voucher yang pernah diambil pelanggan</small>
        </article>

        <article class="admin-voucher-kpi-card admin-voucher-kpi-card--used">
            <span>Voucher Terpakai</span>
            <strong><?php echo e(number_format($totalUsedVouchers, 0, ',', '.')); ?></strong>
            <small>Voucher dengan status used</small>
        </article>

        <article class="admin-voucher-kpi-card admin-voucher-kpi-card--active">
            <span>Voucher Aktif</span>
            <strong><?php echo e(number_format($activeVouchers, 0, ',', '.')); ?></strong>
            <small>Program voucher yang masih aktif</small>
        </article>

    </section>


    
    <section class="admin-voucher-insight-grid">

        <article class="admin-voucher-insight-card">
            <div class="admin-voucher-insight-icon">
                <i class="bi bi-stars"></i>
            </div>

            <div>
                <span>Total Poin Masuk</span>
                <strong>+<?php echo e(number_format($totalPointsEarned, 0, ',', '.')); ?></strong>
                <small>Dari earn, bonus, atau adjustment positif</small>
            </div>
        </article>

        <article class="admin-voucher-insight-card">
            <div class="admin-voucher-insight-icon admin-voucher-insight-icon--redeem">
                <i class="bi bi-ticket-detailed"></i>
            </div>

            <div>
                <span>Total Poin Ditukar</span>
                <strong>-<?php echo e(number_format($totalPointsRedeemed, 0, ',', '.')); ?></strong>
                <small>Dipakai customer saat redeem voucher</small>
            </div>
        </article>

    </section>

    
<section class="admin-voucher-create-card">
    <div class="admin-voucher-create-head">
        <div>
            <span>CREATE REWARD</span>
            <h2>Tambahkan Voucher Baru untuk Customer</h2>
            <p>
                Voucher yang dibuat di sini langsung masuk ke sistem reward customer.
                Jika status aktif dan periode berlaku sesuai, voucher otomatis muncul di halaman Voucher & Bantuan.
            </p>
        </div>

        <div class="admin-voucher-create-badge">
            <i class="bi bi-ticket-perforated-fill"></i>
            Admin Reward Builder
        </div>
    </div>

    <form method="POST" action="<?php echo e(route('admin.vouchers.store')); ?>" class="admin-voucher-create-form">
        <?php echo csrf_field(); ?>

        <div class="admin-voucher-create-grid">

            <div class="admin-voucher-create-field admin-voucher-create-field--wide">
                <label for="name">Nama Voucher</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="Contoh: Diskon Refill 20% / Free Mini Spray 5ml"
                    required
                >
            </div>

            <div class="admin-voucher-create-field admin-voucher-create-field--wide">
                <label for="description">Deskripsi Voucher</label>
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    placeholder="Tuliskan benefit voucher agar mudah dipahami customer..."
                ><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="admin-voucher-create-field">
                <label for="points_cost">Biaya Poin</label>
                <input
                    type="number"
                    id="points_cost"
                    name="points_cost"
                    value="<?php echo e(old('points_cost', 0)); ?>"
                    min="0"
                    placeholder="Contoh: 50"
                    required
                >
            </div>

            <div class="admin-voucher-create-field">
                <label for="reward_type">Jenis Voucher</label>
                <select name="reward_type" id="reward_type_create" required>
                    <option value="">Pilih jenis voucher</option>
                    <option value="discount_percent" <?php echo e(old('reward_type') === 'discount_percent' ? 'selected' : ''); ?>>
                        Diskon Persen
                    </option>
                    <option value="discount_amount" <?php echo e(old('reward_type') === 'discount_amount' ? 'selected' : ''); ?>>
                        Diskon Nominal
                    </option>
                    <option value="free_refill" <?php echo e(old('reward_type') === 'free_refill' ? 'selected' : ''); ?>>
                        QR Vending / Free Refill
                    </option>
                </select>
            </div>

            <div class="admin-voucher-create-field">
                <label for="reward_value">Nilai Reward</label>
                <input
                    type="number"
                    id="reward_value"
                    name="reward_value"
                    value="<?php echo e(old('reward_value', 0)); ?>"
                    min="0"
                    step="0.01"
                    placeholder="15 / 10000 / 5"
                    required
                >
                <small>
                    Persen: isi 15 untuk 15% · Nominal: isi 10000 · QR Refill: isi jumlah ml / benefit
                </small>
            </div>

            <div class="admin-voucher-create-field">
                <label for="max_claim_per_user">Maks. Klaim per User</label>
                <input
                    type="number"
                    id="max_claim_per_user"
                    name="max_claim_per_user"
                    value="<?php echo e(old('max_claim_per_user', 1)); ?>"
                    min="1"
                    max="100"
                    required
                >
            </div>

            <div class="admin-voucher-create-field">
                <label for="start_date">Tanggal Mulai</label>
                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="<?php echo e(old('start_date')); ?>"
                >
            </div>

            <div class="admin-voucher-create-field">
                <label for="end_date">Tanggal Berakhir</label>
                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="<?php echo e(old('end_date')); ?>"
                >
            </div>

            <div class="admin-voucher-create-toggle">
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        <?php echo e(old('is_active', 1) ? 'checked' : ''); ?>

                    >
                    <span>
                        <strong>Aktifkan Voucher</strong>
                        <small>Jika aktif, voucher langsung dapat tampil di halaman customer.</small>
                    </span>
                </label>
            </div>

        </div>


        
        <div class="admin-voucher-machine-box" id="adminVoucherMachineBox">
            <div class="admin-voucher-machine-head">
                <div>
                    <span>QR VENDING STOCK</span>
                    <h3>Pengaturan Reward Mesin</h3>
                    <p>
                        Bagian ini hanya dipakai untuk voucher QR vending / free refill.
                        Admin menentukan nama varian dan jumlah stok reward di tiap lokasi mesin.
                    </p>
                </div>
            </div>

            <div class="admin-voucher-machine-grid">
                <div class="admin-voucher-create-field admin-voucher-create-field--wide">
                    <label for="variant_name">Nama Varian Mesin</label>
                    <input
                        type="text"
                        id="variant_name"
                        name="variant_name"
                        value="<?php echo e(old('variant_name')); ?>"
                        placeholder="Contoh: Free Mini Spray 5ml - Citrus"
                    >
                </div>

                <div class="admin-voucher-create-field">
                    <label for="stock_umn">Stok UMN</label>
                    <input
                        type="number"
                        id="stock_umn"
                        name="stock_umn"
                        value="<?php echo e(old('stock_umn', 0)); ?>"
                        min="0"
                    >
                </div>

                <div class="admin-voucher-create-field">
                    <label for="stock_sms">Stok SMS</label>
                    <input
                        type="number"
                        id="stock_sms"
                        name="stock_sms"
                        value="<?php echo e(old('stock_sms', 0)); ?>"
                        min="0"
                    >
                </div>

                <div class="admin-voucher-create-field">
                    <label for="stock_aeon">Stok AEON</label>
                    <input
                        type="number"
                        id="stock_aeon"
                        name="stock_aeon"
                        value="<?php echo e(old('stock_aeon', 0)); ?>"
                        min="0"
                    >
                </div>
            </div>
        </div>

        <div class="admin-voucher-create-actions">
            <button type="submit" class="admin-voucher-btn admin-voucher-btn--primary">
                <i class="bi bi-plus-circle"></i>
                Tambahkan Voucher
            </button>
        </div>
    </form>
</section>


    
    <section class="admin-voucher-filter-card">
        <div class="admin-voucher-section-head">
            <div>
                <span>Filter Aktivitas</span>
                <h2>Pantau voucher dan pergerakan poin pelanggan</h2>
            </div>
        </div>

        <form method="GET" action="<?php echo e(route('admin.vouchers.index')); ?>" class="admin-voucher-filter-form">

            <div class="admin-voucher-filter-field admin-voucher-filter-field--search">
                <label for="search">Cari Data</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    value="<?php echo e($search); ?>"
                    placeholder="Nama user, email, kode voucher, lokasi, atau deskripsi poin..."
                >
            </div>

            <div class="admin-voucher-filter-field">
                <label for="voucher_status">Status Voucher User</label>
                <select name="voucher_status" id="voucher_status">
                    <option value="">Semua</option>
                    <option value="claimed" <?php echo e($voucherStatus === 'claimed' ? 'selected' : ''); ?>>Claimed</option>
                    <option value="used" <?php echo e($voucherStatus === 'used' ? 'selected' : ''); ?>>Used</option>
                    <option value="expired" <?php echo e($voucherStatus === 'expired' ? 'selected' : ''); ?>>Expired</option>
                </select>
            </div>

            <div class="admin-voucher-filter-field">
                <label for="reward_type">Jenis Reward</label>
                <select name="reward_type" id="reward_type">
                    <option value="">Semua</option>
                    <option value="discount_percent" <?php echo e($rewardType === 'discount_percent' ? 'selected' : ''); ?>>Diskon Persen</option>
                    <option value="discount_amount" <?php echo e($rewardType === 'discount_amount' ? 'selected' : ''); ?>>Diskon Nominal</option>
                    <option value="free_refill" <?php echo e($rewardType === 'free_refill' ? 'selected' : ''); ?>>Free Refill</option>
                    <option value="bonus_points" <?php echo e($rewardType === 'bonus_points' ? 'selected' : ''); ?>>Bonus Poin</option>
                </select>
            </div>

            <div class="admin-voucher-filter-field">
                <label for="point_type">Jenis Transaksi Poin</label>
                <select name="point_type" id="point_type">
                    <option value="">Semua</option>
                    <option value="earn" <?php echo e($pointType === 'earn' ? 'selected' : ''); ?>>Earn</option>
                    <option value="redeem" <?php echo e($pointType === 'redeem' ? 'selected' : ''); ?>>Redeem</option>
                    <option value="adjustment" <?php echo e($pointType === 'adjustment' ? 'selected' : ''); ?>>Adjustment</option>
                    <option value="bonus" <?php echo e($pointType === 'bonus' ? 'selected' : ''); ?>>Bonus</option>
                </select>
            </div>

            <div class="admin-voucher-filter-actions">
                <button type="submit" class="admin-voucher-btn admin-voucher-btn--primary">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>

                <a href="<?php echo e(route('admin.vouchers.index')); ?>" class="admin-voucher-btn admin-voucher-btn--ghost">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </div>

        </form>
    </section>


    
    <section class="admin-voucher-table-card">
        <div class="admin-voucher-table-head">
            <div>
                <span>Aktivitas Customer</span>
                <h2>Riwayat Klaim Voucher Pelanggan</h2>
            </div>

            <div class="admin-voucher-result-pill">
                <?php echo e(number_format($userVouchers->total(), 0, ',', '.')); ?> data
            </div>
        </div>

        <div class="admin-voucher-table-wrap">
            <table class="admin-voucher-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Voucher</th>
                        <th>Kode</th>
                        <th>Channel</th>
                        <th>Lokasi / Varian</th>
                        <th>Status</th>
                        <th>Waktu Klaim</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $userVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userVoucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="admin-voucher-user">
                                    <strong><?php echo e($userVoucher->user->name ?? 'User Tidak Ditemukan'); ?></strong>
                                    <span><?php echo e($userVoucher->user->email ?? '-'); ?></span>
                                </div>
                            </td>

                            <td>
                                <div class="admin-voucher-name">
                                    <strong><?php echo e($userVoucher->voucher->name ?? '-'); ?></strong>
                                    <span><?php echo e(number_format($userVoucher->voucher->points_cost ?? 0, 0, ',', '.')); ?> poin</span>
                                </div>
                            </td>

                            <td>
                                <span class="admin-voucher-code">
                                    <?php echo e($userVoucher->code); ?>

                                </span>
                            </td>

                            <td>
                                <?php if($userVoucher->usage_channel === 'machine_qr'): ?>
                                    <span class="admin-voucher-channel admin-voucher-channel--machine">
                                        Machine QR
                                    </span>
                                <?php else: ?>
                                    <span class="admin-voucher-channel admin-voucher-channel--checkout">
                                        Checkout
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="admin-voucher-location">
                                    <strong><?php echo e($userVoucher->machine_location ?? '-'); ?></strong>
                                    <span><?php echo e($userVoucher->variant_name ?? 'Voucher checkout'); ?></span>
                                </div>
                            </td>

                            <td>
                                <span class="admin-voucher-status admin-voucher-status--<?php echo e($userVoucher->status); ?>">
                                    <?php echo e(strtoupper($userVoucher->status)); ?>

                                </span>
                            </td>

                            <td>
                                <?php echo e($userVoucher->claimed_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-'); ?> WIB
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7">
                                <div class="admin-voucher-empty">
                                    <i class="bi bi-ticket-perforated"></i>
                                    <strong>Belum ada klaim voucher yang sesuai.</strong>
                                    <span>Coba ubah filter atau tunggu aktivitas customer.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($userVouchers->hasPages()): ?>
            <div class="admin-voucher-pagination">
                <?php echo e($userVouchers->links()); ?>

            </div>
        <?php endif; ?>
    </section>


    
    <section class="admin-voucher-table-card">
        <div class="admin-voucher-table-head">
            <div>
                <span>Point Ledger</span>
                <h2>Riwayat Pergerakan Poin Customer</h2>
            </div>

            <div class="admin-voucher-result-pill admin-voucher-result-pill--soft">
                <?php echo e(number_format($pointTransactions->total(), 0, ',', '.')); ?> transaksi
            </div>
        </div>

        <div class="admin-voucher-table-wrap">
            <table class="admin-voucher-table admin-voucher-table--points">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Tipe</th>
                        <th>Poin</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pointTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="admin-voucher-user">
                                    <strong><?php echo e($transaction->user->name ?? 'User Tidak Ditemukan'); ?></strong>
                                    <span><?php echo e($transaction->user->email ?? '-'); ?></span>
                                </div>
                            </td>

                            <td>
                                <span class="admin-point-type admin-point-type--<?php echo e($transaction->type); ?>">
                                    <?php echo e(strtoupper($transaction->type)); ?>

                                </span>
                            </td>

                            <td>
                                <strong class="<?php echo e($transaction->points >= 0 ? 'admin-point-plus' : 'admin-point-minus'); ?>">
                                    <?php echo e($transaction->points >= 0 ? '+' : ''); ?><?php echo e(number_format($transaction->points, 0, ',', '.')); ?>

                                </strong>
                            </td>

                            <td>
                                <?php echo e($transaction->description ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($transaction->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="admin-voucher-empty">
                                    <i class="bi bi-stars"></i>
                                    <strong>Belum ada transaksi poin yang sesuai.</strong>
                                    <span>Transaksi poin customer akan tampil di sini.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($pointTransactions->hasPages()): ?>
            <div class="admin-voucher-pagination">
                <?php echo e($pointTransactions->links()); ?>

            </div>
        <?php endif; ?>
    </section>


    
    <section class="admin-voucher-bottom-grid">

        <article class="admin-voucher-panel-card">
            <div class="admin-voucher-panel-head">
                <span>Master Voucher</span>
                <h2>Program Voucher Tersedia</h2>
            </div>

            <div class="admin-voucher-master-list">
                <?php $__empty_1 = true; $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="admin-voucher-master-item">
                        <div>
                            <strong><?php echo e($voucher->name); ?></strong>
                            <span>
                                <?php echo e(number_format($voucher->points_cost, 0, ',', '.')); ?> poin
                                · <?php echo e(str_replace('_', ' ', strtoupper($voucher->reward_type))); ?>

                            </span>
                        </div>

                        <div class="admin-voucher-master-meta">
                            <b><?php echo e(number_format($voucher->user_vouchers_count, 0, ',', '.')); ?></b>
                            <small>klaim</small>
                        </div>

                        <span class="admin-voucher-program-status <?php echo e($voucher->is_active ? 'is-active' : 'is-off'); ?>">
                            <?php echo e($voucher->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="admin-voucher-empty admin-voucher-empty--small">
                        <strong>Belum ada master voucher.</strong>
                    </div>
                <?php endif; ?>
            </div>
        </article>


        <article class="admin-voucher-panel-card">
            <div class="admin-voucher-panel-head">
                <span>Voucher Stock</span>
                <h2>Stok Reward per Lokasi</h2>
            </div>

            <div class="admin-voucher-stock-list">
                <?php $__empty_1 = true; $__currentLoopData = $voucherStocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $availableStock = max(0, $stock->stock_qty - $stock->reserved_qty);
                    ?>

                    <div class="admin-voucher-stock-item">
                        <div>
                            <strong><?php echo e($stock->voucher->name ?? '-'); ?></strong>
                            <span><?php echo e($stock->machine_location); ?> · <?php echo e($stock->variant_name); ?></span>
                        </div>

                        <div class="admin-voucher-stock-number">
                            <b><?php echo e(number_format($availableStock, 0, ',', '.')); ?></b>
                            <small>sisa</small>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="admin-voucher-empty admin-voucher-empty--small">
                        <strong>Belum ada stok voucher lokasi.</strong>
                    </div>
                <?php endif; ?>
            </div>
        </article>

    </section>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const rewardTypeSelect = document.getElementById('reward_type_create');
    const machineBox = document.getElementById('adminVoucherMachineBox');

    function toggleMachineBox() {
        if (!rewardTypeSelect || !machineBox) return;

        if (rewardTypeSelect.value === 'free_refill') {
            machineBox.classList.add('is-visible');
        } else {
            machineBox.classList.remove('is-visible');
        }
    }

    toggleMachineBox();
    rewardTypeSelect?.addEventListener('change', toggleMachineBox);
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/vouchers/index.blade.php ENDPATH**/ ?>