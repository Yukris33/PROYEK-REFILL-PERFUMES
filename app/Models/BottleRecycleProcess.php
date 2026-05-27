<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BottleRecycleProcess extends Model
{
    protected $fillable = [
        'batch_id',
        'product_id',
        'product_variant_id',
        'processed_quantity',
        'selling_price_per_bottle',
        'total_inventory_value',
        'note',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'selling_price_per_bottle' => 'decimal:2',
        'total_inventory_value' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    public function batch()
    {
        return $this->belongsTo(BottleRecycleBatch::class, 'batch_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}