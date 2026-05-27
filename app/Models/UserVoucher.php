<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    protected $fillable = [
        'user_id',
        'voucher_id',
        'code',
        'usage_channel',
        'status',
        'claimed_at',
        'used_at',
        'expires_at',
        'machine_location',
        'variant_name',
        'voucher_stock_id',
    ];

    protected $casts = [
        'claimed_at' => 'datetime',
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucherStock()
    {
        return $this->belongsTo(VoucherStock::class, 'voucher_stock_id');
    }
}