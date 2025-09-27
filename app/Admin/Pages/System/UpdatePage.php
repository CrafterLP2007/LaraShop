<?php

namespace App\Admin\Pages\System;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class UpdatePage extends Page
{
    protected static ?string $title = 'Update';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-up-circle';
    protected static ?string $navigationLabel = 'Update';
    protected ?string $subheading = "Update your application to the latest version.";
    protected static ?int $navigationSort = 3;
    protected string $view = 'admin.pages.system.update';

    public function getViewData(): array
    {
        return [
            'currentVersion' => '1.2.3',
            'latestVersion' => '1.2.3',
            'lastUpdate' => '2024-06-10',
            'changelogs' => [
                [
                    'version' => '1.2.3',
                    'date' => '2024-06-10',
                    'changes' => [
                        'Fehlerbehebungen im Updateprozess',
                        'Verbesserte Performance',
                    ],
                ],
                [
                    'version' => '1.2.2',
                    'date' => '2024-05-20',
                    'changes' => [
                        'Neues Dashboard hinzugefügt',
                        'Sicherheitsupdate',
                    ],
                ],
            ],
        ];
    }
}
