<?php

namespace App\Admin\Pages\System;

use App\Admin\Resources\FailedJobsResource;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class FailedJobsPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $title = 'Failed Jobs';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationLabel = 'Failed Jobs';
    protected ?string $subheading = 'View and manage failed jobs';
    protected static ?int $navigationSort = 5;
    protected string $view = "admin.pages.system.failed-jobs";

    public function getTableQuery(): Builder
    {
        return FailedJobsResource::getModel()::query();
    }

    public function table(Table $table): Table
    {
        return FailedJobsResource::table($table);
    }
}
