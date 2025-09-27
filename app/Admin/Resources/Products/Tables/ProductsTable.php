<?php

namespace App\Admin\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Name")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label("Description")
                    ->limit(10)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label("Price")
                    ->money('usd', true)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label("Quantity")
                    ->searchable()
                    ->sortable(),
                BooleanColumn::make('hidden')
                    ->label("Hidden")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label("Category")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label("Created At")
                    ->dateTime('M j, Y')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
