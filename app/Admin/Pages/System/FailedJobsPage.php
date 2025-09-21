<?php

namespace App\Admin\Pages\System;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class FailedJobsPage extends Page
{
    protected static ?string $title = 'Failed Jobs';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationLabel = 'Failed Jobs';
    protected static ?int $navigationSort = 5;
}
