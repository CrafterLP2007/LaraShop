<?php

use App\Services\Cart\ShoppingCartService;

if (!function_exists("cart")) {
    function cart(): ShoppingCartService
    {
        return new ShoppingCartService();
    }
}

if (!function_exists('format_price')) {
    function format_price(float $price, bool $withSuffix = false): string
    {
        return number_format($price, 2, ',', '.') . ($withSuffix ?  ' ' . config('transaction.currency_symbol') : '');
    }
}
