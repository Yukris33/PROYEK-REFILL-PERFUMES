<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'brand',
        'category',
        'description',
        'image',
        'status',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}