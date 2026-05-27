<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BottleRecycleBatch;
use App\Models\BottleRecycleProcess;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBottleRecycleController extends Controller
{
    public function index()
    {
        $batches = BottleRecycleBatch::with([
                'machine',
                'collector',
            ])
            ->latest('collected_at')
            ->get();

        $pendingBatches = BottleRecycleBatch::with('machine')
            ->where('remaining_quantity', '>', 0)
            ->latest('collected_at')
            ->get();

        $processes = BottleRecycleProcess::with([
                'batch.machine',
                'product',
                'variant',
                'processor',
            ])
            ->latest('processed_at')
            ->take(12)
            ->get();

        $bottleProducts = Product::with([
                'variants' => function ($query) {
                    $query->where('is_active', true)
                        ->orderBy('size_ml');
                }
            ])
            ->where('category', 'bottle')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $totalWaitingBottles = BottleRecycleBatch::sum('remaining_quantity');

        $totalProcessedBottles = BottleRecycleProcess::sum('processed_quantity');

        $totalRecycleBatches = BottleRecycleBatch::count();

        $totalInventoryValue = BottleRecycleProcess::sum('total_inventory_value');

        return view('admin.recycle-bottles.index', compact(
            'batches',
            'pendingBatches',
            'processes',
            'bottleProducts',
            'totalWaitingBottles',
            'totalProcessedBottles',
            'totalRecycleBatches',
            'totalInventoryValue'
        ));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'batch_id' => ['required', 'exists:bottle_recycle_batches,id'],
            'product_variant_id' => ['required', 'exists:product_variants,id'],
            'processed_quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1500'],
        ]);

        DB::transaction(function () use ($validated) {
            $batch = BottleRecycleBatch::lockForUpdate()
                ->findOrFail($validated['batch_id']);

            $variant = ProductVariant::with('product')
                ->lockForUpdate()
                ->findOrFail($validated['product_variant_id']);

            if (!$variant->product || $variant->product->category !== 'bottle') {
                abort(422, 'Varian yang dipilih harus berasal dari produk botol.');
            }

            $quantity = (int) $validated['processed_quantity'];

            if ($quantity > $batch->remaining_quantity) {
                abort(422, 'Jumlah botol yang diproses melebihi sisa batch recycle.');
            }

            $sellingPricePerBottle = (float) $variant->price;
            $totalInventoryValue = $sellingPricePerBottle * $quantity;

            $variant->increment('stock', $quantity);

            $remaining = $batch->remaining_quantity - $quantity;

            $batch->update([
                'remaining_quantity' => $remaining,
                'status' => $remaining <= 0 ? 'processed' : 'partial',
            ]);

            BottleRecycleProcess::create([
                'batch_id' => $batch->id,
                'product_id' => $variant->product_id,
                'product_variant_id' => $variant->id,
                'processed_quantity' => $quantity,
                'selling_price_per_bottle' => $sellingPricePerBottle,
                'total_inventory_value' => $totalInventoryValue,
                'note' => $validated['note'] ?? null,
                'processed_by' => auth()->id(),
                'processed_at' => now(),
            ]);
        });

        return redirect()
            ->route('admin.recycle-bottles.index')
            ->with('success', 'Botol return berhasil diproses menjadi stok botol higienis siap jual.');
    }
}