<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendingMachineStockLog extends Model
{
    protected $fillable = [
        'vending_machine_id',
        'vending_machine_stock_id',
        'product_id',
        'product_variant_id',
        'action_type',
        'unit_quantity',
        'volume_per_unit_ml',
        'stock_change',
        'previous_stock',
        'new_stock',
        'cost_amount',
        'note',
        'performed_by',
    ];

    protected $casts = [
        'cost_amount' => 'decimal:2',
    ];

    public function machine()
    {
        return $this->belongsTo(VendingMachine::class, 'vending_machine_id');
    }

    public function stock()
    {
        return $this->belongsTo(VendingMachineStock::class, 'vending_machine_stock_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}