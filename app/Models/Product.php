<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'hidden',
        'category_id',
        'extension'
    ];

    protected $casts = [
        'price' => 'float',
        'hidden' => 'boolean',
    ];

    public function extension(): BelongsTo
    {
        return $this->belongsTo(Extension::class);
    }

    public function getThumbnailAttribute(): string
    {
        return asset("storage/{$this->image}");
    }
}
