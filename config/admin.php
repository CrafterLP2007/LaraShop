<?php

return [

    /**
     * --------------------------------------------------------------------------
     * Admin API Configuration
     * --------------------------------------------------------------------------
     *
     * This configuration is used to manage the API access to the admin panel.
     * API access can be enabled or disabled, and an API key can be set to
     * secure the access. You can also define a list of allowed IP addresses
     * that can access the API.
     *
     */
    'api' => [
        'enabled' => env('ADMIN_API_ENABLED', false),
        'api_key' => env('ADMIN_API_KEY'),
        'allowed_ips' => [
            '127.0.0.1'
        ]
    ],

    /**
     * --------------------------------------------------------------------------
     * Admin URL Configuration
     * --------------------------------------------------------------------------
     *
     * This configuration is used to define the URL path to the admin panel.
     * By default, the admin panel is accessible at the /admin URL path. You
     *
     */
    'admin_url' => env('ADMIN_URL', 'admin'),
];
