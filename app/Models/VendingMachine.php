<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendingMachine extends Model
{
    protected $fillable = [
        'machine_code',
        'machine_name',
        'location_name',
        'city',
        'status',
        'last_refill_at',
    ];

    protected $casts = [
        'last_refill_at' => 'datetime',
    ];

    public function stocks()
    {
        return $this->hasMany(VendingMachineStock::class);
    }
    public function stockLogs()
{
    return $this->hasMany(VendingMachineStockLog::class);
}

public function maintenances()
{
    return $this->hasMany(VendingMachineMaintenance::class);
}

}