<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendingMachineMaintenance extends Model
{
    protected $fillable = [
        'vending_machine_id',
        'maintenance_type',
        'status',
        'cost_amount',
        'description',
        'maintenance_date',
        'handled_by',
    ];

    protected $casts = [
        'cost_amount' => 'decimal:2',
        'maintenance_date' => 'datetime',
    ];

    public function machine()
    {
        return $this->belongsTo(VendingMachine::class, 'vending_machine_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}