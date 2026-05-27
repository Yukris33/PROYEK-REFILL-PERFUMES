<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BottleReturnItem extends Model
{
    protected $fillable = [
        'bottle_return_id',
        'bottle_size_ml',
        'points',
        'condition_status',
        'sensor_status',
        'notes',
    ];

    public function bottleReturn()
    {
        return $this->belongsTo(BottleReturn::class);
    }
}