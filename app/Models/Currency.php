<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'symbol',
        'exchange_rate',
        'format',
        'disabled',
    ];

    public function format(float $price): string
    {
        $formattedPrice = number_format($price * $this->exchange_rate, 2);

        return (string) str_replace('{symbol}', $this->symbol, str_replace('{price}', $formattedPrice, $this->format));
    }
}
