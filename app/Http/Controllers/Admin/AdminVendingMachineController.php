<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\VendingMachine;
use App\Models\VendingMachineMaintenance;
use App\Models\VendingMachineStock;
use App\Models\VendingMachineStockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BottleRecycleBatch;

class AdminVendingMachineController extends Controller
{
    public function index()
    {
        $selectedLocation = request('location', 'all');

        $machinesQuery = VendingMachine::with(['stocks.product'])
            ->orderBy('id');

        if ($selectedLocation !== 'all') {
            $machinesQuery->where('machine_code', $selectedLocation);
        }

        $machines = $machinesQuery->get();

        $machineIds = $machines->pluck('id');

        $totalMachines = $machines->count();

        $activeMachines = $machines
            ->where('status', 'active')
            ->count();

        $totalScentStock = VendingMachineStock::whereIn('vending_machine_id', $machineIds)
            ->where('stock_type', 'scent')
            ->sum('current_stock');

        $totalEmptyBottles = VendingMachineStock::whereIn('vending_machine_id', $machineIds)
            ->where('stock_type', 'empty_bottle')
            ->sum('current_stock');

        $totalReturnedBottles = VendingMachineStock::whereIn('vending_machine_id', $machineIds)
            ->where('stock_type', 'returned_bottle')
            ->sum('current_stock');

        $locationOptions = VendingMachine::orderBy('id')->get();

        $variantOptions = ProductVariant::with('product')
            ->where('is_active', true)
            ->orderBy('product_id')
            ->orderBy('size_ml')
            ->get();

            /*
|--------------------------------------------------------------------------
| ALERT STATUS VENDING
|--------------------------------------------------------------------------
*/

$lowScentStocks = VendingMachineStock::with([
        'machine',
        'product',
    ])
    ->whereIn('vending_machine_id', $machineIds)
    ->where('stock_type', 'scent')
    ->whereRaw('current_stock <= max_capacity * 0.25')
    ->orderBy('current_stock', 'asc')
    ->get();

$lowEmptyBottleStocks = VendingMachineStock::with('machine')
    ->whereIn('vending_machine_id', $machineIds)
    ->where('stock_type', 'empty_bottle')
    ->where('current_stock', '<=', 40)
    ->orderBy('current_stock', 'asc')
    ->get();

$highReturnedBottleStocks = VendingMachineStock::with('machine')
    ->whereIn('vending_machine_id', $machineIds)
    ->where('stock_type', 'returned_bottle')
    ->whereRaw('current_stock >= max_capacity * 0.75')
    ->orderBy('current_stock', 'desc')
    ->get();

$activeMaintenances = VendingMachineMaintenance::with('machine')
    ->whereIn('vending_machine_id', $machineIds)
    ->whereIn('status', ['scheduled', 'processing'])
    ->latest('maintenance_date')
    ->get();

$totalOperationalAlerts =
    $lowScentStocks->count()
    + $lowEmptyBottleStocks->count()
    + $highReturnedBottleStocks->count()
    + $activeMaintenances->count();

        return view('admin.vending.index', compact(
            'machines',
            'totalMachines',
            'activeMachines',
            'totalScentStock',
            'totalEmptyBottles',
            'totalReturnedBottles',
            'lowScentStocks',
            'lowEmptyBottleStocks',
            'highReturnedBottleStocks',
            'activeMaintenances',
            'totalOperationalAlerts',
            'selectedLocation',
            'locationOptions',
            'variantOptions'
        ));
    }

    public function refillScent(Request $request)
    {
        $validated = $request->validate([
            'vending_machine_id' => ['required', 'exists:vending_machines,id'],
            'product_variant_id' => ['required', 'exists:product_variants,id'],
            'unit_quantity' => ['required', 'integer', 'min:1'],
            'cost_amount' => ['nullable', 'numeric', 'min:0'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($validated) {
            $variant = ProductVariant::with('product')->findOrFail($validated['product_variant_id']);

            $machine = VendingMachine::findOrFail($validated['vending_machine_id']);

            $stock = VendingMachineStock::where('vending_machine_id', $machine->id)
                ->where('product_id', $variant->product_id)
                ->where('stock_type', 'scent')
                ->firstOrFail();

            $volumePerUnit = (int) $variant->size_ml;
            $unitQuantity = (int) $validated['unit_quantity'];
            $stockAdded = $volumePerUnit * $unitQuantity;

            $previousStock = $stock->current_stock;
            $newStock = $previousStock + $stockAdded;

            $stock->update([
                'current_stock' => $newStock,
            ]);

            $machine->update([
                'last_refill_at' => now(),
            ]);

            VendingMachineStockLog::create([
                'vending_machine_id' => $machine->id,
                'vending_machine_stock_id' => $stock->id,
                'product_id' => $variant->product_id,
                'product_variant_id' => $variant->id,
                'action_type' => 'scent_refill',
                'unit_quantity' => $unitQuantity,
                'volume_per_unit_ml' => $volumePerUnit,
                'stock_change' => $stockAdded,
                'previous_stock' => $previousStock,
                'new_stock' => $newStock,
                'cost_amount' => $validated['cost_amount'] ?? 0,
                'note' => $validated['note'] ?? null,
                'performed_by' => auth()->id(),
            ]);
        });

        return redirect()
            ->route('admin.vending.index')
            ->with('success', 'Stok parfum berhasil ditambahkan.');
    }

    public function addEmptyBottle(Request $request)
    {
        $validated = $request->validate([
            'vending_machine_id' => ['required', 'exists:vending_machines,id'],
            'bottle_quantity' => ['required', 'integer', 'min:1'],
            'cost_amount' => ['nullable', 'numeric', 'min:0'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($validated) {
            $machine = VendingMachine::findOrFail($validated['vending_machine_id']);

            $stock = VendingMachineStock::where('vending_machine_id', $machine->id)
                ->where('stock_type', 'empty_bottle')
                ->firstOrFail();

            $stockAdded = (int) $validated['bottle_quantity'];
            $previousStock = $stock->current_stock;
            $newStock = $previousStock + $stockAdded;

            $stock->update([
                'current_stock' => $newStock,
            ]);

            VendingMachineStockLog::create([
                'vending_machine_id' => $machine->id,
                'vending_machine_stock_id' => $stock->id,
                'product_id' => null,
                'product_variant_id' => null,
                'action_type' => 'empty_bottle_add',
                'unit_quantity' => $stockAdded,
                'volume_per_unit_ml' => null,
                'stock_change' => $stockAdded,
                'previous_stock' => $previousStock,
                'new_stock' => $newStock,
                'cost_amount' => $validated['cost_amount'] ?? 0,
                'note' => $validated['note'] ?? null,
                'performed_by' => auth()->id(),
            ]);
        });

        return redirect()
            ->route('admin.vending.index')
            ->with('success', 'Stok botol kosong berhasil ditambahkan.');
    }

    public function collectReturnedBottle(Request $request)
    {
        $validated = $request->validate([
            'vending_machine_id' => ['required', 'exists:vending_machines,id'],
            'bottle_quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($validated) {
            $machine = VendingMachine::findOrFail($validated['vending_machine_id']);

            $stock = VendingMachineStock::where('vending_machine_id', $machine->id)
                ->where('stock_type', 'returned_bottle')
                ->firstOrFail();

            $collectedQuantity = (int) $validated['bottle_quantity'];

            if ($collectedQuantity > $stock->current_stock) {
    throw \Illuminate\Validation\ValidationException::withMessages([
        'bottle_quantity' => 'Jumlah collect melebihi stok botol return. Sisa stok saat ini: '
            . $stock->current_stock . ' botol.',
    ]);
}
            $previousStock = $stock->current_stock;
            $newStock = $previousStock - $collectedQuantity;

            $stock->update([
                'current_stock' => $newStock,
            ]);

           $stockLog = VendingMachineStockLog::create([
    'vending_machine_id' => $machine->id,
    'vending_machine_stock_id' => $stock->id,
    'product_id' => null,
    'product_variant_id' => null,
    'action_type' => 'returned_bottle_collect',
    'unit_quantity' => $collectedQuantity,
    'volume_per_unit_ml' => null,
    'stock_change' => -$collectedQuantity,
    'previous_stock' => $previousStock,
    'new_stock' => $newStock,
    'cost_amount' => 0,
    'note' => $validated['note'] ?? null,
    'performed_by' => auth()->id(),
]);

BottleRecycleBatch::create([
    'vending_machine_id' => $machine->id,
    'stock_log_id' => $stockLog->id,
    'collected_quantity' => $collectedQuantity,
    'remaining_quantity' => $collectedQuantity,
    'status' => 'pending',
    'note' => $validated['note'] ?? null,
    'collected_by' => auth()->id(),
    'collected_at' => now(),
]);
        });

        return redirect()
            ->route('admin.vending.index')
            ->with('success', 'Botol return berhasil di-collect.');
    }

    public function storeMaintenance(Request $request)
    {
        $validated = $request->validate([
            'vending_machine_id' => ['required', 'exists:vending_machines,id'],
            'maintenance_type' => [
                'required',
                'in:sensor,esp32,qr_scanner,dispenser_pump,internet_connection,power_supply,cleaning_calibration,other'
            ],
            'status' => ['required', 'in:scheduled,processing,completed'],
            'cost_amount' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1500'],
            'maintenance_date' => ['nullable', 'date'],
        ]);

        VendingMachineMaintenance::create([
            'vending_machine_id' => $validated['vending_machine_id'],
            'maintenance_type' => $validated['maintenance_type'],
            'status' => $validated['status'],
            'cost_amount' => $validated['cost_amount'] ?? 0,
            'description' => $validated['description'] ?? null,
            'maintenance_date' => $validated['maintenance_date'] ?? now(),
            'handled_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.vending.index')
            ->with('success', 'Catatan maintenance berhasil disimpan.');
    }
}