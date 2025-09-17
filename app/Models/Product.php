<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'hidden',
        'category_id',
        'extension',
    ];

    protected $casts = [
        'price' => 'float',
        'hidden' => 'boolean',
    ];

    public function images(): HasMany|Product
    {
        return $this->hasMany(ProductImage::class);
    }
}
