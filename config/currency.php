<?php

return [
    /**
     * --------------------------------------------------------------------------
     * Default Currency
     * --------------------------------------------------------------------------
     *
     * This configuration option specifies the default currency for your application.
     * The default currency is used whenever a currency is not explicitly provided
     * in your business logic, payment processing, or display formatting.
     * You should set this value to one of the currency codes defined in the
     * "currencies" array below. This ensures consistency across your application
     * when handling monetary values, conversions, and formatting.
     * For example, if your main market is Europe, you might set this to 'EUR'.
     * If you expand to other regions, you can change this value accordingly.
     */
    'currency' => 'EUR',

    /**
     * --------------------------------------------------------------------------
     * Supported Currencies
     * --------------------------------------------------------------------------
     *
     * The "currencies" array defines all currencies supported by your application.
     * Each currency is represented by its ISO code (e.g., 'USD', 'EUR') and contains
     * detailed information for formatting, conversion, and display purposes.
     *
     * - 'symbol': The character or string used to represent the currency (e.g., '$', '€').
     * - 'name': The full name of the currency, useful for dropdowns or descriptions.
     * - 'symbol_first': Boolean indicating if the symbol appears before the amount (true)
     *   or after (false). This affects how prices are displayed to users.
     * - 'decimal_mark': The character used to separate the integer part from the decimal
     *   part of the amount (e.g., '.' for USD, ',' for EUR).
     * - 'thousands_separator': The character used to separate thousands in large numbers
     *   (e.g., ',' for USD, '.' for EUR).
     * - 'subunit': The name of the currency's subunit (e.g., 'Cent' for both USD and EUR).
     * - 'subunit_to_unit': The number of subunits that make up one unit of the currency
     *   (e.g., 100 cents in 1 dollar or 1 euro).
     *
     * You can add more currencies to this array as your application grows to support
     * additional regions or payment methods. Make sure to provide accurate formatting
     * details for each currency to ensure correct display and calculation.
     */
    'currencies' => [
        'USD' => [
            'symbol' => '$',
            'name' => 'US Dollar',
            'symbol_first' => true,
            'decimal_mark' => '.',
            'thousands_separator' => ',',
            'subunit' => 'Cent',
            'subunit_to_unit' => 100,
        ],
        'EUR' => [
            'symbol' => '€',
            'name' => 'Euro',
            'symbol_first' => false,
            'decimal_mark' => ',',
            'thousands_separator' => '.',
            'subunit' => 'Cent',
            'subunit_to_unit' => 100,
        ],
    ],
];
