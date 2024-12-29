<?php

return [
    /**
     * --------------------------------------------------------------------------
     * Order Job Configuration
     * --------------------------------------------------------------------------
     *
     * Here you can configure the job settings for the order.
     *
     */
    'jobs' => [
        'create' => [
            'queue' => 'default',
            'tries' => 3,
            'delays' => [
                60,
                120
            ]
        ],

        'refund' => [
            'queue' => 'default',
            'tries' => 3,
            'delays' => [
                60,
                120
            ]
        ],

        'cancel' => [
            'queue' => 'default',
            'tries' => 3,
            'delays' => [
                60,
                120
            ]
        ]
    ],

    /**
     * --------------------------------------------------------------------------
     * Order Confirmation Code Generator
     * --------------------------------------------------------------------------
     *
     * Here you can configure the confirmation code generator for the order that
     * will be used to confirm the order via email.
     *
     */
    'confirmation_code_generator' => \Illuminate\Support\Str::random(32)
];
