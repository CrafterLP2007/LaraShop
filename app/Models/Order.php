<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'product_ids',
        'total_amount',
        'status',
        'payment_method',
        'address',
        'city',
        'zip_code',
        'country',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];
}
