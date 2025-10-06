<?php

namespace App\Classes;

use App\Helpers\Theme;

class Settings
{
    public static function settings()
    {
        $settings = [
            'general' => [
                [
                    'name' => 'site_name',
                    'label' => 'Site Name',
                    'type' => 'text',
                    'override' => 'app.name',
                    'default' => 'LaraShop'
                ],

                [
                    'name' => 'site_url',
                    'label' => 'Site URL',
                    'type' => 'text',
                    'override' => 'app.url',
                    'default' => config('app.url'),
                    'placeholder' => 'https://example.com',
                    'rules' => ['url']
                ],

                [
                    'name' => 'site_email',
                    'label' => 'Site Email',
                    'type' => 'email',
                    'default' => '',
                    'placeholder' => '',
                    'rules' => ['email']
                ],

                [
                    'name' => 'timezone',
                    'label' => 'Timezone',
                    'type' => 'select',
                    'default' => 'UTC',
                    'options' => array_combine(timezone_identifiers_list(), timezone_identifiers_list()),
                    'rules' => ['in:' . implode(',', timezone_identifiers_list())]
                ],
            ],

            'theme' => [

            ]
        ];

        $settings['theme'] = [...$settings['theme'], ...Theme::getThemeSettings()];

        return $settings;
    }
}
