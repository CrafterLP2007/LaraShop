<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        // Create default currency EUR
        Currency::create([
            'code' => 'EUR',
            'symbol' => '€',
            'exchange_rate' => 1.00,
            'format' => '{price} {symbol}',
        ]);

        // Create additional currency USD
        Currency::create([
            'code' => 'USD',
            'symbol' => '$',
            'exchange_rate' => 1.10,
            'format' => '{symbol}{price}',
        ]);

        // Create additional currency GBP
        Currency::create([
            'code' => 'GBP',
            'symbol' => '£',
            'exchange_rate' => 0.85,
            'format' => '{symbol}{price}',
        ]);
    }
}
