

<?php $__env->startSection('title', 'Vending Machine Monitoring - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Vending Machine'); ?>

<?php $__env->startSection('content'); ?>

<?php if($errors->has('bottle_quantity')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert(<?php echo json_encode($errors->first('bottle_quantity'), 15, 512) ?>);
        });
    </script>
<?php endif; ?>

    <?php
        $visualMachine = $machines->first();

        $visualTitle = $selectedLocation === 'all'
            ? 'SCENTCYCLE Multi-Location Console'
            : ($visualMachine->machine_name ?? 'SCENTCYCLE Vending Machine');

        $visualLocation = $selectedLocation === 'all'
            ? 'UMN • SMS • AEON'
            : (($visualMachine->location_name ?? '-') . ($visualMachine?->city ? ', ' . $visualMachine->city : ''));

        $visualStatus = $selectedLocation === 'all'
            ? ($activeMachines > 0 ? 'active' : 'inactive')
            : strtolower($visualMachine->status ?? 'active');

        $visualMaxScent = $machines->sum(function ($machine) {
            return $machine->stocks
                ->where('stock_type', 'scent')
                ->sum('max_capacity');
        });

        $visualFillPercentage = $visualMaxScent > 0
            ? round(($totalScentStock / $visualMaxScent) * 100)
            : 0;

        $visualLastRefill = $selectedLocation !== 'all' && $visualMachine?->last_refill_at
            ? $visualMachine->last_refill_at->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB'
            : 'Mode monitoring gabungan';
    ?>


    
    <section class="admin-vending-kpi-grid">

        <article class="admin-vending-kpi-card">
            <span>Total Mesin</span>
            <strong><?php echo e(number_format($totalMachines, 0, ',', '.')); ?></strong>
            <small>Seluruh vending machine terdaftar</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--active">
            <span>Mesin Aktif</span>
            <strong><?php echo e(number_format($activeMachines, 0, ',', '.')); ?></strong>
            <small>Vending machine dengan status active</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--scent">
            <span>Total Stok Scent</span>
            <strong><?php echo e(number_format($totalScentStock, 0, ',', '.')); ?></strong>
            <small>Akumulasi volume parfum seluruh mesin</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--bottle">
            <span>Botol Kosong</span>
            <strong><?php echo e(number_format($totalEmptyBottles, 0, ',', '.')); ?></strong>
            <small>Botol baru siap digunakan</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--return">
            <span>Botol Return</span>
            <strong><?php echo e(number_format($totalReturnedBottles, 0, ',', '.')); ?></strong>
            <small>Botol bekas yang terkumpul</small>
        </article>

    </section>


    
    <section class="admin-vending-filter-card">
        <div>
            <span class="admin-vending-filter-eyebrow">Filter Lokasi</span>
            <h2>
                Monitoring:
                <?php if($selectedLocation === 'all'): ?>
                    Semua Lokasi
                <?php else: ?>
                    <?php echo e($locationOptions->firstWhere('machine_code', $selectedLocation)?->machine_name ?? 'Lokasi Terpilih'); ?>

                <?php endif; ?>
            </h2>
        </div>

        <form method="GET" action="<?php echo e(route('admin.vending.index')); ?>" class="admin-vending-filter-form">
            <label for="location">Pilih Lokasi Mesin</label>

            <select name="location" id="location" onchange="this.form.submit()">
                <option value="all" <?php echo e($selectedLocation === 'all' ? 'selected' : ''); ?>>
                    Semua Lokasi
                </option>

                <?php $__currentLoopData = $locationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($location->machine_code); ?>"
                        <?php echo e($selectedLocation === $location->machine_code ? 'selected' : ''); ?>>
                        <?php echo e($location->machine_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>
    </section>

    
<section class="admin-vending-alert-section">

    <div class="admin-vending-alert-head">
        <div>
            <span>Operational Alert</span>
            <h2>Status vending yang perlu diperhatikan</h2>
            <p>
                Alert muncul otomatis dari stok mesin dan catatan maintenance yang masih aktif.
            </p>
        </div>

        <div class="admin-vending-alert-count <?php echo e($totalOperationalAlerts > 0 ? 'has-alert' : 'is-safe'); ?>">
            <strong><?php echo e($totalOperationalAlerts); ?></strong>
            <span><?php echo e($totalOperationalAlerts > 0 ? 'Alert Aktif' : 'Semua Aman'); ?></span>
        </div>
    </div>

    <?php if($totalOperationalAlerts > 0): ?>
        <div class="admin-vending-alert-grid">

            
            <?php $__currentLoopData = $lowScentStocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="admin-vending-alert-card admin-vending-alert-card--warning">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-droplet-half"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Stok parfum menipis</strong>
                        <span>
                            <?php echo e($stock->machine->machine_name ?? '-'); ?>

                        </span>
                        <p>
                            <?php echo e($stock->item_name); ?>

                        </p>
                        <small>
                            Sisa <?php echo e(number_format($stock->current_stock, 0, ',', '.')); ?>

                            <?php echo e($stock->unit); ?>

                            dari kapasitas <?php echo e(number_format($stock->max_capacity, 0, ',', '.')); ?>

                            <?php echo e($stock->unit); ?>

                        </small>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            
            <?php $__currentLoopData = $lowEmptyBottleStocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="admin-vending-alert-card admin-vending-alert-card--danger">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Botol kosong rendah</strong>
                        <span>
                            <?php echo e($stock->machine->machine_name ?? '-'); ?>

                        </span>
                        <p>
                            Stok botol kosong perlu segera ditambah.
                        </p>
                        <small>
                            Tersisa <?php echo e(number_format($stock->current_stock, 0, ',', '.')); ?>

                            <?php echo e($stock->unit); ?>

                        </small>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            
            <?php $__currentLoopData = $highReturnedBottleStocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="admin-vending-alert-card admin-vending-alert-card--return">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-recycle"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Botol return hampir penuh</strong>
                        <span>
                            <?php echo e($stock->machine->machine_name ?? '-'); ?>

                        </span>
                        <p>
                            Return bin perlu dikoleksi agar tidak overload.
                        </p>
                        <small>
                            Terkumpul <?php echo e(number_format($stock->current_stock, 0, ',', '.')); ?>

                            <?php echo e($stock->unit); ?>

                            dari kapasitas <?php echo e(number_format($stock->max_capacity, 0, ',', '.')); ?>

                            <?php echo e($stock->unit); ?>

                        </small>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            
            <?php $__currentLoopData = $activeMaintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="admin-vending-alert-card admin-vending-alert-card--maintenance">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-tools"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Maintenance <?php echo e(ucfirst($maintenance->status)); ?></strong>
                        <span>
                            <?php echo e($maintenance->machine->machine_name ?? '-'); ?>

                        </span>
                        <p>
                            <?php echo e(str_replace('_', ' ', ucfirst($maintenance->maintenance_type))); ?>

                        </p>
                        <small>
                            <?php echo e($maintenance->maintenance_date?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-'); ?> WIB
                        </small>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    <?php else: ?>
        <div class="admin-vending-alert-empty">
            <i class="bi bi-shield-check"></i>
            <strong>Semua kondisi vending masih aman.</strong>
            <span>
                Tidak ada stok kritis, botol return penuh, atau maintenance aktif.
            </span>
        </div>
    <?php endif; ?>

</section>


    
    <section class="admin-vending-actions-card">

        <div class="admin-vending-actions-head">
            <div>
                <span>Operasional Mesin</span>
                <h2>Kelola stok, bottle return, dan maintenance</h2>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="admin-vending-success-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <div class="admin-vending-top-grid">

            
           <div class="admin-vending-visual-card admin-vending-visual-card--full">

    <div class="admin-vending-visual-header">
        <span class="admin-vending-visual-kicker">Smart Refill Console</span>
        <h3><?php echo e($visualTitle); ?></h3>
        <p>
            Visualisasi operasional vending machine SCENTCYCLE.
            Sistem memantau stok parfum, botol kosong, bottle return,
            serta aktivitas mesin berdasarkan lokasi yang dipilih.
        </p>
    </div>

    <div class="admin-vending-command-center">

        
        <div class="admin-vending-visual-machine admin-vending-visual-machine--expanded">
            <div class="machine-glow machine-glow--large"></div>
            <div class="machine-orbit machine-orbit--one"></div>
            <div class="machine-orbit machine-orbit--two"></div>

            <div class="machine-body machine-body--large">

                <div class="machine-top">
                    <span class="machine-brand">SCENTCYCLE</span>
                    <span class="machine-status <?php echo e($visualStatus); ?>">
                        <?php echo e(strtoupper($visualStatus)); ?>

                    </span>
                </div>

                <div class="machine-screen machine-screen--animated">
                    <div class="screen-scan-line"></div>

                    <div class="screen-title">Lokasi Aktif</div>
                    <div class="screen-value">
                        <?php echo e($visualLocation); ?>

                    </div>

                    <div class="screen-mini-grid">
                        <div class="screen-box">
                            <span>Total Scent</span>
                            <strong><?php echo e(number_format($totalScentStock, 0, ',', '.')); ?> ml</strong>
                        </div>

                        <div class="screen-box">
                            <span>Botol Return</span>
                            <strong><?php echo e(number_format($totalReturnedBottles, 0, ',', '.')); ?></strong>
                        </div>
                    </div>
                </div>

                <div class="machine-refill-zone">
                    <div class="machine-bottles machine-bottles--large">
                        <span class="bottle bottle-1"></span>
                        <span class="bottle bottle-2"></span>
                        <span class="bottle bottle-3"></span>
                    </div>

                    <div class="refill-stream refill-stream--one"></div>
                    <div class="refill-stream refill-stream--two"></div>
                    <div class="refill-stream refill-stream--three"></div>
                </div>

                <div class="machine-footer-bar">
                    <span class="footer-dot"></span>
                    <span class="footer-dot"></span>
                    <span class="footer-dot"></span>
                    <span class="footer-dot"></span>
                    <span class="footer-dot"></span>
                </div>
            </div>
        </div>


        
        <div class="admin-vending-live-panel">

            <div class="live-panel-head">
                <span class="live-pulse"></span>
                <strong>Live Machine Monitor</strong>
            </div>

            <div class="live-monitor-grid">

                <div class="live-monitor-card">
                    <span>Refill Capacity</span>
                    <strong><?php echo e(number_format($visualFillPercentage, 0)); ?>%</strong>
                    <div class="visual-progress visual-progress--thick">
                        <div
                            class="visual-progress-bar"
                            style="width: <?php echo e(min(max($visualFillPercentage, 0), 100)); ?>%;">
                        </div>
                    </div>
                </div>

                <div class="live-monitor-card">
                    <span>Botol Kosong</span>
                    <strong><?php echo e(number_format($totalEmptyBottles, 0, ',', '.')); ?></strong>
                    <small>Siap digunakan</small>
                </div>

                <div class="live-monitor-card">
                    <span>Last Refill</span>
                    <strong class="live-monitor-small">
                        <?php echo e($visualLastRefill); ?>

                    </strong>
                </div>

            </div>

        </div>

    </div>


    
    <div class="admin-vending-visual-lower-grid">

        <div class="admin-vending-sensor-board">
            <div class="sensor-board-head">
                <span>IoT Sensor Status</span>
                <h4>Module Operational</h4>
            </div>

            <div class="sensor-board-list">

                <div class="sensor-module">
                    <div class="sensor-icon sensor-icon--pulse">
                        <i class="bi bi-wifi"></i>
                    </div>
                    <div>
                        <strong>ESP32 Connected</strong>
                        <span>Data telemetry aktif</span>
                    </div>
                    <em>Online</em>
                </div>

                <div class="sensor-module">
                    <div class="sensor-icon">
                        <i class="bi bi-droplet"></i>
                    </div>
                    <div>
                        <strong>Liquid Sensor</strong>
                        <span>Monitoring volume scent</span>
                    </div>
                    <em>Stable</em>
                </div>

                <div class="sensor-module">
                    <div class="sensor-icon">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <div>
                        <strong>QR Refill Scanner</strong>
                        <span>Validasi refill aktif</span>
                    </div>
                    <em>Ready</em>
                </div>

            </div>
        </div>


        <div class="admin-vending-flow-board">
            <div class="sensor-board-head">
                <span>System Flow</span>
                <h4>Refill Operation</h4>
            </div>

            <div class="vending-flow-track">

                <div class="flow-step flow-step--qr">
                    <i class="bi bi-qr-code-scan"></i>
                    <span>Scan QR</span>
                </div>

                <div class="flow-connector">
                    <span></span>
                </div>

                <div class="flow-step flow-step--refill">
                    <i class="bi bi-droplet-half"></i>
                    <span>Auto Refill</span>
                </div>

                <div class="flow-connector">
                    <span></span>
                </div>

                <div class="flow-step flow-step--return">
                    <i class="bi bi-recycle"></i>
                    <span>Bottle Return</span>
                </div>

            </div>

            <div class="flow-board-summary">
                <div>
                    <span>Total Mesin</span>
                    <strong><?php echo e(number_format($totalMachines, 0, ',', '.')); ?></strong>
                </div>

                <div>
                    <span>Mesin Aktif</span>
                    <strong><?php echo e(number_format($activeMachines, 0, ',', '.')); ?></strong>
                </div>

                <div>
                    <span>Return Botol</span>
                    <strong><?php echo e(number_format($totalReturnedBottles, 0, ',', '.')); ?></strong>
                </div>
            </div>
        </div>

    </div>

</div>


            
            <div class="admin-vending-action-grid admin-vending-action-grid--sidebar">

                
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-droplet-half"></i>
                        <div>
                            <span>Stock In</span>
                            <h3>Isi Ulang Parfum</h3>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.vending.refill-scent')); ?>" class="admin-vending-action-form">
                        <?php echo csrf_field(); ?>

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                <?php $__currentLoopData = $locationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($location->id); ?>">
                                        <?php echo e($location->machine_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Scent & Ukuran Produksi</label>
                            <select name="product_variant_id" required>
                                <option value="">Pilih scent dan ukuran</option>
                                <?php $__currentLoopData = $variantOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($variant->id); ?>">
                                        <?php echo e($variant->product->name ?? 'Produk'); ?> — <?php echo e($variant->size_ml); ?> ml
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Jumlah Unit Produksi</label>
                            <input type="number" name="unit_quantity" min="1" placeholder="Contoh: 20" required>
                        </div>

                        <div class="admin-vending-field">
                            <label>Biaya Produksi</label>
                            <input type="number" name="cost_amount" min="0" placeholder="Contoh: 300000">
                        </div>

                        <div class="admin-vending-field">
                            <label>Catatan</label>
                            <textarea name="note" rows="3" placeholder="Opsional..."></textarea>
                        </div>

                        <button type="submit" class="admin-vending-action-btn">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Stok Parfum
                        </button>
                    </form>
                </article>


                
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-box-seam"></i>
                        <div>
                            <span>Supply</span>
                            <h3>Tambah Botol Kosong</h3>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.vending.add-empty-bottle')); ?>" class="admin-vending-action-form">
                        <?php echo csrf_field(); ?>

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                <?php $__currentLoopData = $locationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($location->id); ?>">
                                        <?php echo e($location->machine_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Jumlah Botol Kosong</label>
                            <input type="number" name="bottle_quantity" min="1" placeholder="Contoh: 50" required>
                        </div>

                        <div class="admin-vending-field">
                            <label>Biaya Pengadaan</label>
                            <input type="number" name="cost_amount" min="0" placeholder="Contoh: 75000">
                        </div>

                        <div class="admin-vending-field">
                            <label>Catatan</label>
                            <textarea name="note" rows="3" placeholder="Opsional..."></textarea>
                        </div>

                        <button type="submit" class="admin-vending-action-btn">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Botol Kosong
                        </button>
                    </form>
                </article>


                
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-arrow-down-circle"></i>
                        <div>
                            <span>Return Handling</span>
                            <h3>Collect Botol Return</h3>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.vending.collect-returned-bottle')); ?>" class="admin-vending-action-form">
                        <?php echo csrf_field(); ?>

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                <?php $__currentLoopData = $locationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($location->id); ?>">
                                        <?php echo e($location->machine_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Jumlah Botol Diambil</label>
                            <input type="number" name="bottle_quantity" min="1" placeholder="Contoh: 20" required>
                        </div>

                        <div class="admin-vending-field">
                            <label>Catatan</label>
                            <textarea name="note" rows="3" placeholder="Opsional..."></textarea>
                        </div>

                        <button type="submit" class="admin-vending-action-btn">
                            <i class="bi bi-check2-circle"></i>
                            Simpan Collection
                        </button>
                    </form>
                </article>


                
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-tools"></i>
                        <div>
                            <span>Machine Care</span>
                            <h3>Catat Maintenance</h3>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.vending.maintenance')); ?>" class="admin-vending-action-form">
                        <?php echo csrf_field(); ?>

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                <?php $__currentLoopData = $locationOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($location->id); ?>">
                                        <?php echo e($location->machine_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Jenis Maintenance</label>
                            <select name="maintenance_type" required>
                                <option value="sensor">Sensor Volume</option>
                                <option value="esp32">ESP32 / IoT Board</option>
                                <option value="qr_scanner">QR Scanner</option>
                                <option value="dispenser_pump">Dispenser Pump</option>
                                <option value="internet_connection">Koneksi Internet</option>
                                <option value="power_supply">Power Supply</option>
                                <option value="cleaning_calibration">Cleaning & Kalibrasi</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Status</label>
                            <select name="status" required>
                                <option value="scheduled">Scheduled</option>
                                <option value="processing">Processing</option>
                                <option value="completed" selected>Completed</option>
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Biaya Maintenance</label>
                            <input type="number" name="cost_amount" min="0" placeholder="Contoh: 150000">
                        </div>

                        <div class="admin-vending-field">
                            <label>Tanggal Maintenance</label>
                            <input type="datetime-local" name="maintenance_date">
                        </div>

                        <div class="admin-vending-field">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="3" placeholder="Contoh: sensor pembacaan volume kurang stabil..."></textarea>
                        </div>

                        <button type="submit" class="admin-vending-action-btn">
                            <i class="bi bi-save"></i>
                            Simpan Maintenance
                        </button>
                    </form>
                </article>

            </div>
        </div>

    </section>


    
    <section class="admin-vending-note">
        <div class="admin-vending-note__icon">
            <i class="bi bi-cpu"></i>
        </div>

        <div>
            <h2>Monitoring operasional vending machine aktif</h2>
            <p>
                Admin dapat memantau lokasi mesin, status operasional, total stok parfum,
                ketersediaan botol kosong, serta jumlah botol return.
                Gunakan filter lokasi untuk melihat kondisi seluruh mesin secara gabungan
                atau fokus pada UMN, SMS, dan AEON secara terpisah.
            </p>
        </div>
    </section>


    
    <section class="admin-vending-machine-list">

        <?php $__empty_1 = true; $__currentLoopData = $machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $scentStocks = $machine->stocks->where('stock_type', 'scent');
                $emptyBottle = $machine->stocks->firstWhere('stock_type', 'empty_bottle');
                $returnedBottle = $machine->stocks->firstWhere('stock_type', 'returned_bottle');

                $machineTotalScent = $scentStocks->sum('current_stock');
                $machineMaxScent = $scentStocks->sum('max_capacity');

                $scentPercentage = $machineMaxScent > 0
                    ? round(($machineTotalScent / $machineMaxScent) * 100)
                    : 0;
            ?>

            <article class="admin-vending-machine-card">

                <div class="admin-vending-machine-head">
                    <div>
                        <span class="admin-vending-machine-eyebrow">Machine Branch</span>
                        <h2><?php echo e($machine->machine_name); ?></h2>

                        <div class="admin-vending-machine-meta">
                            <span>
                                <i class="bi bi-upc-scan"></i>
                                <?php echo e($machine->machine_code); ?>

                            </span>

                            <span>
                                <i class="bi bi-geo-alt"></i>
                                <?php echo e($machine->location_name); ?><?php echo e($machine->city ? ', ' . $machine->city : ''); ?>

                            </span>
                        </div>
                    </div>

                    <div class="admin-vending-machine-status">
                        <span class="admin-vending-status-pill admin-vending-status-pill--<?php echo e($machine->status); ?>">
                            <?php echo e(ucfirst($machine->status)); ?>

                        </span>

                        <small>
                            Last refill:
                            <?php echo e($machine->last_refill_at ? $machine->last_refill_at->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB' : 'Belum tercatat'); ?>

                        </small>
                    </div>
                </div>


                <div class="admin-vending-summary-grid">

                    <div class="admin-vending-summary-box">
                        <span>Total Volume Scent</span>
                        <strong><?php echo e(number_format($machineTotalScent, 0, ',', '.')); ?></strong>
                        <small>Dari <?php echo e($scentStocks->count()); ?> slot scent</small>
                    </div>

                    <div class="admin-vending-summary-box">
                        <span>Kapasitas Scent Terisi</span>
                        <strong><?php echo e($scentPercentage); ?>%</strong>
                        <div class="admin-vending-progress">
                            <span style="width: <?php echo e(min($scentPercentage, 100)); ?>%;"></span>
                        </div>
                    </div>

                    <div class="admin-vending-summary-box">
                        <span>Botol Kosong</span>
                        <strong><?php echo e(number_format($emptyBottle->current_stock ?? 0, 0, ',', '.')); ?></strong>
                        <small><?php echo e($emptyBottle->unit ?? 'botol'); ?></small>
                    </div>

                    <div class="admin-vending-summary-box">
                        <span>Botol Return</span>
                        <strong><?php echo e(number_format($returnedBottle->current_stock ?? 0, 0, ',', '.')); ?></strong>
                        <small><?php echo e($returnedBottle->unit ?? 'botol'); ?></small>
                    </div>

                </div>


                <div class="admin-vending-stock-table-card">
                    <div class="admin-vending-stock-table-head">
                        <div>
                            <span>Stock Detail</span>
                            <h3>Stok Item per Mesin</h3>
                        </div>
                    </div>

                    <div class="admin-vending-table-wrap">
                        <table class="admin-vending-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Tipe</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Kapasitas Maksimal</th>
                                    <th>Persentase</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $machine->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $stockPercentage = $stock->max_capacity > 0
                                            ? round(($stock->current_stock / $stock->max_capacity) * 100)
                                            : 0;

                                        if ($stock->current_stock <= 0) {
                                            $stockCondition = 'empty';
                                            $stockConditionLabel = 'Kosong';
                                        } elseif ($stockPercentage <= 25) {
                                            $stockCondition = 'low';
                                            $stockConditionLabel = 'Menipis';
                                        } else {
                                            $stockCondition = 'safe';
                                            $stockConditionLabel = 'Aman';
                                        }
                                    ?>

                                    <tr>
                                        <td>
                                            <strong><?php echo e($stock->item_name); ?></strong>
                                        </td>

                                        <td>
                                            <span class="admin-vending-type-pill admin-vending-type-pill--<?php echo e($stock->stock_type); ?>">
                                                <?php echo e(str_replace('_', ' ', ucfirst($stock->stock_type))); ?>

                                            </span>
                                        </td>

                                        <td>
                                            <?php echo e(number_format($stock->current_stock, 0, ',', '.')); ?>

                                            <?php echo e($stock->unit); ?>

                                        </td>

                                        <td>
                                            <?php echo e(number_format($stock->max_capacity, 0, ',', '.')); ?>

                                            <?php echo e($stock->unit); ?>

                                        </td>

                                        <td>
                                            <div class="admin-vending-table-progress">
                                                <span style="width: <?php echo e(min($stockPercentage, 100)); ?>%;"></span>
                                            </div>
                                            <small><?php echo e($stockPercentage); ?>%</small>
                                        </td>

                                        <td>
                                            <span class="admin-vending-condition admin-vending-condition--<?php echo e($stockCondition); ?>">
                                                <?php echo e($stockConditionLabel); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <section class="admin-vending-empty">
                <i class="bi bi-cpu"></i>
                <strong>Belum ada vending machine.</strong>
                <span>Tambahkan data mesin terlebih dahulu melalui database atau seeder.</span>
            </section>
        <?php endif; ?>

    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/vending/index.blade.php ENDPATH**/ ?>