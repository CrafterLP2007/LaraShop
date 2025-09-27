<?php

namespace App\Admin\Resources\Currencies;

use App\Admin\Resources\Currencies\Pages\CreateCurrencies;
use App\Admin\Resources\Currencies\Pages\EditCurrencies;
use App\Admin\Resources\Currencies\Pages\ListCurrencies;
use App\Admin\Resources\Currencies\Schemas\CurrenciesForm;
use App\Admin\Resources\Currencies\Tables\CurrenciesTable;
use App\Models\Currency;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CurrenciesResource extends Resource
{
    protected static ?string $model = Currency::class;
    protected static string | UnitEnum | null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Currencies';

    public static function form(Schema $schema): Schema
    {
        return CurrenciesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrenciesTable::configure($table);
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
            'index' => ListCurrencies::route('/'),
            'create' => CreateCurrencies::route('/create'),
            'edit' => EditCurrencies::route('/{record}/edit'),
        ];
    }
}
