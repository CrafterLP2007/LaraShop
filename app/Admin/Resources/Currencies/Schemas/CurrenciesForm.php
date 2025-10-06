<?php

namespace App\Admin\Resources\Currencies\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CurrenciesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('code')
                            ->label('Currency Code')
                            ->required()
                            ->maxLength(10),
                        TextInput::make('symbol')
                            ->label('Currency Symbol')
                            ->required()
                            ->maxLength(10),
                        TextInput::make('exchange_rate')
                            ->label('Exchange Rate')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                    ]),
                TextInput::make('format')
                    ->label('Currency Format')
                    ->required()
                    ->maxLength(50)
                    ->helperText('Use {symbol} for currency symbol and {value} for amount, e.g., {symbol}{value}')
                    ->columnSpanFull(),

                Checkbox::make('disabled')
                    ->label('Disabled')
                    ->helperText('If checked, this currency will not be available for selection in the application.'),
            ]);
    }
}
