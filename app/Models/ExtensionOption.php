<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtensionOption extends Model
{
    protected $fillable = [
        'extension_identifier',
        'key',
        'value'
    ];
}
