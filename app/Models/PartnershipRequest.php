<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'business_name',
        'message',
        'status',
    ];
}