<?php

return [
    /**
     * --------------------------------------------------------------------------
     * Stripe configuration
     * --------------------------------------------------------------------------
     *
     * This is the configuration for the Stripe payment gateway.
     *
     */
    'stripe' => [
        'api_key' => env('STRIPE_API_KEY'),
        'api_secret' => env('STRIPE_API_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    ],

    /**
     * --------------------------------------------------------------------------
     * Currency configuration
     * --------------------------------------------------------------------------
     *
     * This is the default currency for the application. This currency will be
     * used to format the prices in the application.
     * Available options: EUR, USD, GBP, etc.
     *
     */
    'currency' => 'EUR',

    /**
     * --------------------------------------------------------------------------
     * Currency symbol configuration
     * --------------------------------------------------------------------------
     *
     * This is the default currency symbol for the application. This currency
     * symbol will be used to format the prices in the application.
     *
     */
    'currency_symbol' => '€',
];
