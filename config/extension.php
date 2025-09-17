<?php

return [
    /**
     * --------------------------------------------------------------------------
     * Extensions Path
     * --------------------------------------------------------------------------
     *
     * This value is the path where all extensions are stored. You can change this
     * to any path you want. Make sure the path is correct and writable.
     *
     */
    'path' => base_path('Extensions'),

    /**
     * --------------------------------------------------------------------------
     * Extensions Namespace
     * --------------------------------------------------------------------------
     *
     * This value is the namespace where all extensions are stored. You can change this
     * to any namespace you want. Make sure the namespace is correct and matches
     * the folder structure.
     *
     */
    'namespace' => 'Extensions\\',

    /**
     * --------------------------------------------------------------------------
     * Extensions Cache
     * --------------------------------------------------------------------------
     *
     * This value is used to configure the extensions cache. You can enable or
     * disable the cache, set the duration for which the cache is valid, and
     * set a prefix for the cache keys.
     *
     */
    'cache' => [

        /**
         * ----------------------------------------------------------------------
         * Enable/Disable Extensions Cache
         * ----------------------------------------------------------------------
         *
         * This value is used to enable or disable the extensions cache. If
         * enabled, the extensions will be cached for the duration
         * specified in the duration key.
         *
         */
        'enabled' => true,

        /**
         * ----------------------------------------------------------------------
         * Cache Duration
         * ----------------------------------------------------------------------
         *
         * This value is the duration in seconds for which the extensions
         * will be cached. You can change this to any value you want.
         * Make sure to set a reasonable value to avoid performance issues.
         */
        'duration' => 60 * 60,

        /**
         * ----------------------------------------------------------------------
         * Cache Prefix
         * ----------------------------------------------------------------------
         *
         * This value is the prefix that will be used for the cache keys.
         * You can change this to any value you want. Make sure to set a
         * unique prefix to avoid cache key collisions.
         */
        'prefix' => 'extension_'
    ]
];
