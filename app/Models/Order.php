<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'order_code',
        'subtotal',
        'discount_amount',
        'points_used',
        'points_earned',
        'grand_total',
        'status',
        'payment_status',
        'notes',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class);
}

}