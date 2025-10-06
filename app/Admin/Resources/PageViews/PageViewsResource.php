<?php

namespace App\Admin\Resources\PageViews;

use App\Admin\Resources\PageViews\Pages\CreatePageViews;
use App\Admin\Resources\PageViews\Pages\EditPageViews;
use App\Admin\Resources\PageViews\Pages\ListPageViews;
use App\Admin\Resources\PageViews\Schemas\PageViewsForm;
use App\Admin\Resources\PageViews\Tables\PageViewsTable;
use App\Models\PageViews;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PageViewsResource extends Resource
{
    protected static ?string $model = PageViews::class;
    protected static string | UnitEnum | null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWindow;
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationLabel = 'Pages';
    protected static ?string $recordTitleAttribute = 'Pages';

    public static function form(Schema $schema): Schema
    {
        return PageViewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageViewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageViews::route('/'),
            'create' => CreatePageViews::route('/create'),
            'edit' => EditPageViews::route('/{record}/edit'),
        ];
    }
}
