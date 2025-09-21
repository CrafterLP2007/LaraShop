<?php

namespace App\Admin\Pages;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class MonitorPage extends Page
{
    protected static ?string $title = 'Monitor';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Monitor';
    protected static ?int $navigationSort = 2;
}
