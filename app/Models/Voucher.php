<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'name',
        'description',
        'points_cost',
        'reward_type',
        'reward_value',
        'start_date',
        'end_date',
        'is_active',
        'max_claim_per_user',
        'requires_activity',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'requires_activity' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'reward_value' => 'decimal:2',
    ];

    public function userVouchers()
    {
        return $this->hasMany(UserVoucher::class);
    }

    public function stocks()
    {
        return $this->hasMany(VoucherStock::class);
    }

    public function isAvailable()
    {
        $today = now()->toDateString();

        if (!$this->is_active) {
            return false;
        }

        if ($this->start_date && $this->start_date->toDateString() > $today) {
            return false;
        }

        if ($this->end_date && $this->end_date->toDateString() < $today) {
            return false;
        }

        return true;
    }
}