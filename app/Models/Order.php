<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(OrderObserver::class)]
class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'product_ids',
        'status',
        'price',
        'discount_percentage',
        'extension',
        'address',
        'city',
        'state',
        'zip_code',
    ];

    protected $casts = [
        'product_ids' => 'array',
        'status' => OrderStatus::class,
        'price' => 'float',
        'discount_percentage' => 'float',
    ];

    public function extension(): BelongsTo
    {
        return $this->belongsTo(Extension::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
