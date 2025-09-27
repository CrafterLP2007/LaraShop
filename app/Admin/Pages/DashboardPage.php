<?php

namespace App\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class DashboardPage extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string|\BackedEnum|null $activeNavigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 1;

    public function getWidgets(): array
    {
        return [

        ];
    }
}
