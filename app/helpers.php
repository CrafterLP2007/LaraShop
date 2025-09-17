<?php

use App\Helpers\ShoppingCartHelper;
use Qirolab\Theme\Theme;

if (!function_exists("format_price")) {
    /**
     * Format a price with the given currency symbol.
     *
     * @param float $price
     * @param string $currencySymbol
     * @return string
     */
    function format_price(float $price, string $currencySymbol = '€'): string
    {
        return number_format($price, 2) . ' ' . $currencySymbol;
    }
}

if (!function_exists("calculate_discounted_price")) {
    /**
     * Calculate the discounted price.
     *
     * @param float $price
     * @param float $discountPercentage
     * @return float
     */
    function calculate_discounted_price(float $price, float $discountPercentage): float
    {
        if ($discountPercentage <= 0 || $discountPercentage >= 100) {
            return $price;
        }

        return round($price - ($price * ($discountPercentage / 100)), 2);
    }
}

if (!function_exists("cart")) {
    /**
     * Get the shopping cart service instance.
     *
     * @return ShoppingCartHelper
     */
    function cart(): ShoppingCartHelper
    {
        return app(ShoppingCartHelper::class);
    }
}

if (!function_exists("theme")) {
    /**
     * Get the current theme.
     *
     * @return string
     */
    function theme(): string
    {
        return Theme::active() ?? 'default';
    }
}

if (!function_exists("theme_path")) {
    /**
     * Get the parent theme.
     *
     * @param $path
     * @return string|null
     */
    function theme_path($path): ?string
    {
        $basePath = config('theme.base_path', base_path('themes'));
        return $basePath . '/' . theme() . '/' . ltrim($path, '/');
    }
}

if (!function_exists("extensions_path")) {
    function extensions_path(string $extension, string $path = ''): ?string
    {
        $extensionPath =  rtrim(config('extension.path'), '/') . '/' . ltrim($extension, '/');

        if (!$path) {
            return $extensionPath;
        }

        return $extensionPath . '/' . ltrim($path, '/');
    }
}
