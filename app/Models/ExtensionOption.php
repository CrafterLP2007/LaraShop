<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ExtensionOption extends Model
{
    protected $fillable = [
        'extension_name',
        'key',
        'value'
    ];

    public function settings(): MorphMany
    {
        return $this->morph();
    }
}
