<?php

namespace App\Admin\Resources\Categories;

use App\Admin\Resources\Categories\Pages\CreateCategories;
use App\Admin\Resources\Categories\Pages\EditCategories;
use App\Admin\Resources\Categories\Pages\ListCategories;
use App\Admin\Resources\Categories\Schemas\CategoriesForm;
use App\Admin\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CategoriesResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static string | UnitEnum | null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Categories';

    public static function form(Schema $schema): Schema
    {
        return CategoriesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategories::route('/create'),
            'edit' => EditCategories::route('/{record}/edit'),
        ];
    }
}
