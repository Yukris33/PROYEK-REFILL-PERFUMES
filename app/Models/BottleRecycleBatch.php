<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BottleRecycleBatch extends Model
{
    protected $fillable = [
        'vending_machine_id',
        'stock_log_id',
        'collected_quantity',
        'remaining_quantity',
        'status',
        'note',
        'collected_by',
        'collected_at',
    ];

    protected $casts = [
        'collected_at' => 'datetime',
    ];

    public function machine()
    {
        return $this->belongsTo(VendingMachine::class, 'vending_machine_id');
    }

    public function stockLog()
    {
        return $this->belongsTo(VendingMachineStockLog::class, 'stock_log_id');
    }

    public function collector()
    {
        return $this->belongsTo(User::class, 'collected_by');
    }

    public function processes()
    {
        return $this->hasMany(BottleRecycleProcess::class, 'batch_id');
    }
}