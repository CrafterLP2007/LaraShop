<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'hidden',
    ];

    protected $casts = [
        'price' => 'float',
        'hidden' => 'boolean',
    ];

    public function getThumbnailAttribute(): string
    {
        return asset("storage/{$this->image}");
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, ',', '.');
    }
}
