<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'title',
        'description',
        'parent_id',
        'order'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany|Category
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany|Category
    {
        return $this->hasMany(Product::class);
    }
}
