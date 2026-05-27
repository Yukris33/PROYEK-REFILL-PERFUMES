@extends('admin.layouts.app')

@section('title', 'Vending Machine Monitoring - SCENTCYCLE')
@section('page_title', 'Vending Machine')

@section('content')

@if($errors->has('bottle_quantity'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert(@json($errors->first('bottle_quantity')));
        });
    </script>
@endif

    @php
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
    @endphp


    {{-- =========================
        KPI VENDING MACHINE
    ========================== --}}
    <section class="admin-vending-kpi-grid">

        <article class="admin-vending-kpi-card">
            <span>Total Mesin</span>
            <strong>{{ number_format($totalMachines, 0, ',', '.') }}</strong>
            <small>Seluruh vending machine terdaftar</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--active">
            <span>Mesin Aktif</span>
            <strong>{{ number_format($activeMachines, 0, ',', '.') }}</strong>
            <small>Vending machine dengan status active</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--scent">
            <span>Total Stok Scent</span>
            <strong>{{ number_format($totalScentStock, 0, ',', '.') }}</strong>
            <small>Akumulasi volume parfum seluruh mesin</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--bottle">
            <span>Botol Kosong</span>
            <strong>{{ number_format($totalEmptyBottles, 0, ',', '.') }}</strong>
            <small>Botol baru siap digunakan</small>
        </article>

        <article class="admin-vending-kpi-card admin-vending-kpi-card--return">
            <span>Botol Return</span>
            <strong>{{ number_format($totalReturnedBottles, 0, ',', '.') }}</strong>
            <small>Botol bekas yang terkumpul</small>
        </article>

    </section>


    {{-- =========================
        FILTER LOKASI VENDING
    ========================== --}}
    <section class="admin-vending-filter-card">
        <div>
            <span class="admin-vending-filter-eyebrow">Filter Lokasi</span>
            <h2>
                Monitoring:
                @if($selectedLocation === 'all')
                    Semua Lokasi
                @else
                    {{ $locationOptions->firstWhere('machine_code', $selectedLocation)?->machine_name ?? 'Lokasi Terpilih' }}
                @endif
            </h2>
        </div>

        <form method="GET" action="{{ route('admin.vending.index') }}" class="admin-vending-filter-form">
            <label for="location">Pilih Lokasi Mesin</label>

            <select name="location" id="location" onchange="this.form.submit()">
                <option value="all" {{ $selectedLocation === 'all' ? 'selected' : '' }}>
                    Semua Lokasi
                </option>

                @foreach($locationOptions as $location)
                    <option value="{{ $location->machine_code }}"
                        {{ $selectedLocation === $location->machine_code ? 'selected' : '' }}>
                        {{ $location->machine_name }}
                    </option>
                @endforeach
            </select>
        </form>
    </section>

    {{-- =========================
    ALERT STATUS VENDING
========================== --}}
<section class="admin-vending-alert-section">

    <div class="admin-vending-alert-head">
        <div>
            <span>Operational Alert</span>
            <h2>Status vending yang perlu diperhatikan</h2>
            <p>
                Alert muncul otomatis dari stok mesin dan catatan maintenance yang masih aktif.
            </p>
        </div>

        <div class="admin-vending-alert-count {{ $totalOperationalAlerts > 0 ? 'has-alert' : 'is-safe' }}">
            <strong>{{ $totalOperationalAlerts }}</strong>
            <span>{{ $totalOperationalAlerts > 0 ? 'Alert Aktif' : 'Semua Aman' }}</span>
        </div>
    </div>

    @if($totalOperationalAlerts > 0)
        <div class="admin-vending-alert-grid">

            {{-- ALERT STOK PARFUM MENIPIS --}}
            @foreach($lowScentStocks as $stock)
                <article class="admin-vending-alert-card admin-vending-alert-card--warning">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-droplet-half"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Stok parfum menipis</strong>
                        <span>
                            {{ $stock->machine->machine_name ?? '-' }}
                        </span>
                        <p>
                            {{ $stock->item_name }}
                        </p>
                        <small>
                            Sisa {{ number_format($stock->current_stock, 0, ',', '.') }}
                            {{ $stock->unit }}
                            dari kapasitas {{ number_format($stock->max_capacity, 0, ',', '.') }}
                            {{ $stock->unit }}
                        </small>
                    </div>
                </article>
            @endforeach


            {{-- ALERT BOTOL KOSONG RENDAH --}}
            @foreach($lowEmptyBottleStocks as $stock)
                <article class="admin-vending-alert-card admin-vending-alert-card--danger">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Botol kosong rendah</strong>
                        <span>
                            {{ $stock->machine->machine_name ?? '-' }}
                        </span>
                        <p>
                            Stok botol kosong perlu segera ditambah.
                        </p>
                        <small>
                            Tersisa {{ number_format($stock->current_stock, 0, ',', '.') }}
                            {{ $stock->unit }}
                        </small>
                    </div>
                </article>
            @endforeach


            {{-- ALERT BOTOL RETURN TERLALU BANYAK --}}
            @foreach($highReturnedBottleStocks as $stock)
                <article class="admin-vending-alert-card admin-vending-alert-card--return">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-recycle"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Botol return hampir penuh</strong>
                        <span>
                            {{ $stock->machine->machine_name ?? '-' }}
                        </span>
                        <p>
                            Return bin perlu dikoleksi agar tidak overload.
                        </p>
                        <small>
                            Terkumpul {{ number_format($stock->current_stock, 0, ',', '.') }}
                            {{ $stock->unit }}
                            dari kapasitas {{ number_format($stock->max_capacity, 0, ',', '.') }}
                            {{ $stock->unit }}
                        </small>
                    </div>
                </article>
            @endforeach


            {{-- ALERT MAINTENANCE AKTIF --}}
            @foreach($activeMaintenances as $maintenance)
                <article class="admin-vending-alert-card admin-vending-alert-card--maintenance">
                    <div class="admin-vending-alert-icon">
                        <i class="bi bi-tools"></i>
                    </div>

                    <div class="admin-vending-alert-copy">
                        <strong>Maintenance {{ ucfirst($maintenance->status) }}</strong>
                        <span>
                            {{ $maintenance->machine->machine_name ?? '-' }}
                        </span>
                        <p>
                            {{ str_replace('_', ' ', ucfirst($maintenance->maintenance_type)) }}
                        </p>
                        <small>
                            {{ $maintenance->maintenance_date?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }} WIB
                        </small>
                    </div>
                </article>
            @endforeach

        </div>
    @else
        <div class="admin-vending-alert-empty">
            <i class="bi bi-shield-check"></i>
            <strong>Semua kondisi vending masih aman.</strong>
            <span>
                Tidak ada stok kritis, botol return penuh, atau maintenance aktif.
            </span>
        </div>
    @endif

</section>


    {{-- =========================
        VISUAL VENDING + FORM OPERASIONAL
    ========================== --}}
    <section class="admin-vending-actions-card">

        <div class="admin-vending-actions-head">
            <div>
                <span>Operasional Mesin</span>
                <h2>Kelola stok, bottle return, dan maintenance</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="admin-vending-success-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="admin-vending-top-grid">

            {{-- =========================
                KIRI — VISUAL VENDING MACHINE
            ========================== --}}
           <div class="admin-vending-visual-card admin-vending-visual-card--full">

    <div class="admin-vending-visual-header">
        <span class="admin-vending-visual-kicker">Smart Refill Console</span>
        <h3>{{ $visualTitle }}</h3>
        <p>
            Visualisasi operasional vending machine SCENTCYCLE.
            Sistem memantau stok parfum, botol kosong, bottle return,
            serta aktivitas mesin berdasarkan lokasi yang dipilih.
        </p>
    </div>

    <div class="admin-vending-command-center">

        {{-- =========================
            MESIN UTAMA
        ========================== --}}
        <div class="admin-vending-visual-machine admin-vending-visual-machine--expanded">
            <div class="machine-glow machine-glow--large"></div>
            <div class="machine-orbit machine-orbit--one"></div>
            <div class="machine-orbit machine-orbit--two"></div>

            <div class="machine-body machine-body--large">

                <div class="machine-top">
                    <span class="machine-brand">SCENTCYCLE</span>
                    <span class="machine-status {{ $visualStatus }}">
                        {{ strtoupper($visualStatus) }}
                    </span>
                </div>

                <div class="machine-screen machine-screen--animated">
                    <div class="screen-scan-line"></div>

                    <div class="screen-title">Lokasi Aktif</div>
                    <div class="screen-value">
                        {{ $visualLocation }}
                    </div>

                    <div class="screen-mini-grid">
                        <div class="screen-box">
                            <span>Total Scent</span>
                            <strong>{{ number_format($totalScentStock, 0, ',', '.') }} ml</strong>
                        </div>

                        <div class="screen-box">
                            <span>Botol Return</span>
                            <strong>{{ number_format($totalReturnedBottles, 0, ',', '.') }}</strong>
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


        {{-- =========================
            STATUS LIVE SAMPING MESIN
        ========================== --}}
        <div class="admin-vending-live-panel">

            <div class="live-panel-head">
                <span class="live-pulse"></span>
                <strong>Live Machine Monitor</strong>
            </div>

            <div class="live-monitor-grid">

                <div class="live-monitor-card">
                    <span>Refill Capacity</span>
                    <strong>{{ number_format($visualFillPercentage, 0) }}%</strong>
                    <div class="visual-progress visual-progress--thick">
                        <div
                            class="visual-progress-bar"
                            style="width: {{ min(max($visualFillPercentage, 0), 100) }}%;">
                        </div>
                    </div>
                </div>

                <div class="live-monitor-card">
                    <span>Botol Kosong</span>
                    <strong>{{ number_format($totalEmptyBottles, 0, ',', '.') }}</strong>
                    <small>Siap digunakan</small>
                </div>

                <div class="live-monitor-card">
                    <span>Last Refill</span>
                    <strong class="live-monitor-small">
                        {{ $visualLastRefill }}
                    </strong>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        PANEL SENSOR & ALUR
    ========================== --}}
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
                    <strong>{{ number_format($totalMachines, 0, ',', '.') }}</strong>
                </div>

                <div>
                    <span>Mesin Aktif</span>
                    <strong>{{ number_format($activeMachines, 0, ',', '.') }}</strong>
                </div>

                <div>
                    <span>Return Botol</span>
                    <strong>{{ number_format($totalReturnedBottles, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>

    </div>

</div>


            {{-- =========================
                KANAN — FORM OPERASIONAL
            ========================== --}}
            <div class="admin-vending-action-grid admin-vending-action-grid--sidebar">

                {{-- FORM 1: ISI ULANG PARFUM --}}
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-droplet-half"></i>
                        <div>
                            <span>Stock In</span>
                            <h3>Isi Ulang Parfum</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.vending.refill-scent') }}" class="admin-vending-action-form">
                        @csrf

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                @foreach($locationOptions as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->machine_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="admin-vending-field">
                            <label>Scent & Ukuran Produksi</label>
                            <select name="product_variant_id" required>
                                <option value="">Pilih scent dan ukuran</option>
                                @foreach($variantOptions as $variant)
                                    <option value="{{ $variant->id }}">
                                        {{ $variant->product->name ?? 'Produk' }} — {{ $variant->size_ml }} ml
                                    </option>
                                @endforeach
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


                {{-- FORM 2: TAMBAH BOTOL KOSONG --}}
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-box-seam"></i>
                        <div>
                            <span>Supply</span>
                            <h3>Tambah Botol Kosong</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.vending.add-empty-bottle') }}" class="admin-vending-action-form">
                        @csrf

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                @foreach($locationOptions as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->machine_name }}
                                    </option>
                                @endforeach
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


                {{-- FORM 3: COLLECT BOTOL RETURN --}}
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-arrow-down-circle"></i>
                        <div>
                            <span>Return Handling</span>
                            <h3>Collect Botol Return</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.vending.collect-returned-bottle') }}" class="admin-vending-action-form">
                        @csrf

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                @foreach($locationOptions as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->machine_name }}
                                    </option>
                                @endforeach
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


                {{-- FORM 4: MAINTENANCE --}}
                <article class="admin-vending-action-card">
                    <div class="admin-vending-action-card__head">
                        <i class="bi bi-tools"></i>
                        <div>
                            <span>Machine Care</span>
                            <h3>Catat Maintenance</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.vending.maintenance') }}" class="admin-vending-action-form">
                        @csrf

                        <div class="admin-vending-field">
                            <label>Lokasi Mesin</label>
                            <select name="vending_machine_id" required>
                                @foreach($locationOptions as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->machine_name }}
                                    </option>
                                @endforeach
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


    {{-- =========================
        NOTE MONITORING
    ========================== --}}
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


    {{-- =========================
        MACHINE LIST
    ========================== --}}
    <section class="admin-vending-machine-list">

        @forelse($machines as $machine)
            @php
                $scentStocks = $machine->stocks->where('stock_type', 'scent');
                $emptyBottle = $machine->stocks->firstWhere('stock_type', 'empty_bottle');
                $returnedBottle = $machine->stocks->firstWhere('stock_type', 'returned_bottle');

                $machineTotalScent = $scentStocks->sum('current_stock');
                $machineMaxScent = $scentStocks->sum('max_capacity');

                $scentPercentage = $machineMaxScent > 0
                    ? round(($machineTotalScent / $machineMaxScent) * 100)
                    : 0;
            @endphp

            <article class="admin-vending-machine-card">

                <div class="admin-vending-machine-head">
                    <div>
                        <span class="admin-vending-machine-eyebrow">Machine Branch</span>
                        <h2>{{ $machine->machine_name }}</h2>

                        <div class="admin-vending-machine-meta">
                            <span>
                                <i class="bi bi-upc-scan"></i>
                                {{ $machine->machine_code }}
                            </span>

                            <span>
                                <i class="bi bi-geo-alt"></i>
                                {{ $machine->location_name }}{{ $machine->city ? ', ' . $machine->city : '' }}
                            </span>
                        </div>
                    </div>

                    <div class="admin-vending-machine-status">
                        <span class="admin-vending-status-pill admin-vending-status-pill--{{ $machine->status }}">
                            {{ ucfirst($machine->status) }}
                        </span>

                        <small>
                            Last refill:
                            {{ $machine->last_refill_at ? $machine->last_refill_at->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB' : 'Belum tercatat' }}
                        </small>
                    </div>
                </div>


                <div class="admin-vending-summary-grid">

                    <div class="admin-vending-summary-box">
                        <span>Total Volume Scent</span>
                        <strong>{{ number_format($machineTotalScent, 0, ',', '.') }}</strong>
                        <small>Dari {{ $scentStocks->count() }} slot scent</small>
                    </div>

                    <div class="admin-vending-summary-box">
                        <span>Kapasitas Scent Terisi</span>
                        <strong>{{ $scentPercentage }}%</strong>
                        <div class="admin-vending-progress">
                            <span style="width: {{ min($scentPercentage, 100) }}%;"></span>
                        </div>
                    </div>

                    <div class="admin-vending-summary-box">
                        <span>Botol Kosong</span>
                        <strong>{{ number_format($emptyBottle->current_stock ?? 0, 0, ',', '.') }}</strong>
                        <small>{{ $emptyBottle->unit ?? 'botol' }}</small>
                    </div>

                    <div class="admin-vending-summary-box">
                        <span>Botol Return</span>
                        <strong>{{ number_format($returnedBottle->current_stock ?? 0, 0, ',', '.') }}</strong>
                        <small>{{ $returnedBottle->unit ?? 'botol' }}</small>
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
                                @foreach($machine->stocks as $stock)
                                    @php
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
                                    @endphp

                                    <tr>
                                        <td>
                                            <strong>{{ $stock->item_name }}</strong>
                                        </td>

                                        <td>
                                            <span class="admin-vending-type-pill admin-vending-type-pill--{{ $stock->stock_type }}">
                                                {{ str_replace('_', ' ', ucfirst($stock->stock_type)) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ number_format($stock->current_stock, 0, ',', '.') }}
                                            {{ $stock->unit }}
                                        </td>

                                        <td>
                                            {{ number_format($stock->max_capacity, 0, ',', '.') }}
                                            {{ $stock->unit }}
                                        </td>

                                        <td>
                                            <div class="admin-vending-table-progress">
                                                <span style="width: {{ min($stockPercentage, 100) }}%;"></span>
                                            </div>
                                            <small>{{ $stockPercentage }}%</small>
                                        </td>

                                        <td>
                                            <span class="admin-vending-condition admin-vending-condition--{{ $stockCondition }}">
                                                {{ $stockConditionLabel }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </article>
        @empty
            <section class="admin-vending-empty">
                <i class="bi bi-cpu"></i>
                <strong>Belum ada vending machine.</strong>
                <span>Tambahkan data mesin terlebih dahulu melalui database atau seeder.</span>
            </section>
        @endforelse

    </section>

@endsection