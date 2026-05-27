@extends('admin.layouts.app')

@section('title', 'Recycle Botol - SCENTCYCLE')
@section('page_title', 'Recycle Botol')

@section('content')

@if(session('success'))
    <div class="admin-recycle-alert admin-recycle-alert--success">
        <i class="bi bi-check-circle-fill"></i>
        <div>
            <strong>Berhasil</strong>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="admin-recycle-alert admin-recycle-alert--error">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Proses belum valid</strong>
            <span>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </span>
        </div>
    </div>
@endif


{{-- =========================
    KPI
========================= --}}
<section class="admin-recycle-kpi-grid">

    <article class="admin-recycle-kpi-card">
        <span>Menunggu Recycle</span>
        <strong>{{ number_format($totalWaitingBottles, 0, ',', '.') }}</strong>
        <small>Botol return yang belum diproses</small>
    </article>

    <article class="admin-recycle-kpi-card">
        <span>Sudah Diproses</span>
        <strong>{{ number_format($totalProcessedBottles, 0, ',', '.') }}</strong>
        <small>Botol menjadi stok higienis</small>
    </article>

    <article class="admin-recycle-kpi-card">
        <span>Total Batch</span>
        <strong>{{ number_format($totalRecycleBatches, 0, ',', '.') }}</strong>
        <small>Batch hasil collect dari vending</small>
    </article>

    <article class="admin-recycle-kpi-card">
        <span>Nilai Stok Recycle</span>
        <strong>Rp{{ number_format($totalInventoryValue, 0, ',', '.') }}</strong>
        <small>Estimasi nilai jual botol hasil recycle</small>
    </article>

</section>


{{-- =========================
    FLOW + FORM PROCESS
========================= --}}
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

        <form method="POST" action="{{ route('admin.recycle-bottles.process') }}" class="admin-recycle-form">
            @csrf

            <label>
                Batch Collect
                <select name="batch_id" required>
                    <option value="">Pilih batch return</option>

                    @foreach($pendingBatches as $batch)
                        <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                            Batch #{{ $batch->id }}
                            · {{ $batch->machine->machine_name ?? '-' }}
                            · sisa {{ $batch->remaining_quantity }} botol
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Produk & Ukuran Botol Tujuan
                <select name="product_variant_id" id="recycleVariantSelect" required>
                    <option value="">Pilih varian botol</option>

                    @foreach($bottleProducts as $product)
                        @foreach($product->variants as $variant)
                            <option
                                value="{{ $variant->id }}"
                                data-price="{{ $variant->price }}"
                                data-product="{{ $product->name }}"
                                data-size="{{ $variant->size_ml }}"
                                {{ old('product_variant_id') == $variant->id ? 'selected' : '' }}
                            >
                                {{ $product->name }} · {{ $variant->size_ml }}ml
                                · Rp{{ number_format($variant->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </label>

            <label>
                Jumlah Botol Diproses
                <input
                    type="number"
                    name="processed_quantity"
                    min="1"
                    value="{{ old('processed_quantity') }}"
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
                >{{ old('note') }}</textarea>
            </label>

            <button type="submit">
                <i class="bi bi-recycle"></i>
                Proses Recycle Botol
            </button>
        </form>
    </article>

</section>


{{-- =========================
    BATCH QUEUE
========================= --}}
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
                @forelse($batches as $batch)
                    <tr>
                        <td>
                            <strong>#{{ $batch->id }}</strong>
                        </td>

                        <td>
                            {{ $batch->machine->machine_name ?? '-' }}
                        </td>

                        <td>
                            {{ number_format($batch->collected_quantity, 0, ',', '.') }} botol
                        </td>

                        <td>
                            {{ number_format($batch->remaining_quantity, 0, ',', '.') }} botol
                        </td>

                        <td>
                            <span class="admin-recycle-status admin-recycle-status--{{ $batch->status }}">
                                {{ strtoupper($batch->status) }}
                            </span>
                        </td>

                        <td>
                            {{ $batch->collected_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }} WIB
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="admin-recycle-empty">
                                Belum ada batch return dari vending machine.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>


{{-- =========================
    PROCESS HISTORY
========================= --}}
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
                @forelse($processes as $process)
                    <tr>
                        <td>
                            #{{ $process->batch_id }}
                        </td>

                        <td>
                            <strong>{{ $process->product->name ?? '-' }}</strong><br>
                            <small>{{ $process->variant->size_ml ?? '-' }}ml</small>
                        </td>

                        <td>
                            {{ number_format($process->processed_quantity, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp{{ number_format($process->selling_price_per_bottle, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp{{ number_format($process->total_inventory_value, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $process->processed_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }} WIB
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="admin-recycle-empty">
                                Belum ada proses recycle yang tercatat.
                            </div>
                        </td>
                    </tr>
                @endforelse
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

@endsection