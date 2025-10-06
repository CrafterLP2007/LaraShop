<?php

return [
    'metadata' => [
        'title' => 'Default Theme',
        'description' => 'The default theme that comes with the application.',
        'version' => '1.0.0',
        'author' => 'Your Company or Name',
    ],

    'configuration' => [
        [
            'name' => 'primary_color',
            'label' => 'Primary Color',
            'type' => 'color',
            'default' => '#3490dc',
            'helperText' => 'The primary color used throughout the application.',
            'placeholder' => '#3490dc',
            'rules' => ['regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ],
    ]
];
