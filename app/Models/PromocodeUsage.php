<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromocodeUsage extends Model
{
    protected $fillable = [
        'promocode_id',
        'user_id',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function promocode(): BelongsTo
    {
        return $this->belongsTo(Promocode::class);
    }
}
