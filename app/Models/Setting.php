<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'entity_type',
        'entity_id'
    ];

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
