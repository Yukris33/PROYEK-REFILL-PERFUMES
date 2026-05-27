<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherStock extends Model
{
    protected $fillable = [
        'voucher_id',
        'machine_location',
        'variant_name',
        'stock_qty',
        'reserved_qty',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function availableStock()
    {
        return max(0, $this->stock_qty - $this->reserved_qty);
    }
}