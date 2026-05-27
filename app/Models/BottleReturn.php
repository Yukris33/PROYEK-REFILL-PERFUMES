<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BottleReturn extends Model
{
    protected $fillable = [
        'user_id',
        'return_code',
        'machine_location',
        'total_bottles',
        'estimated_points',
        'awarded_points',
        'status',
        'scanned_at',
        'received_at',
        'validated_at',
        'points_awarded_at',
        'notes',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
        'received_at' => 'datetime',
        'validated_at' => 'datetime',
        'points_awarded_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(BottleReturnItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}