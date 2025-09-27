<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }
}
