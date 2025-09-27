<?php

namespace App\Admin\Resources\Products;

use App\Admin\Resources\Products\Pages\CreateProduct;
use App\Admin\Resources\Products\Pages\EditProduct;
use App\Admin\Resources\Products\Pages\ListProducts;
use App\Admin\Resources\Products\Schemas\ProductForm;
use App\Admin\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static string | UnitEnum | null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Products';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
