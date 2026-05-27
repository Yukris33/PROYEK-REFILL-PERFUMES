<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendingMachineStock extends Model
{
    protected $fillable = [
        'vending_machine_id',
        'product_id',
        'stock_type',
        'item_name',
        'current_stock',
        'max_capacity',
        'unit',
    ];

    public function machine()
    {
        return $this->belongsTo(VendingMachine::class, 'vending_machine_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}