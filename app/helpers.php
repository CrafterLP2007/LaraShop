<?php

use App\Services\Cart\ShoppingCartService;

if (!function_exists("cart")) {
    function cart(): ShoppingCartService
    {
        return new ShoppingCartService();
    }
}
