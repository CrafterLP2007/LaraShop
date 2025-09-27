<?php

namespace App\Admin\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->toggleable()
                    ->sortable()
                    ->limit(10)
                    ->placeholder('None'),
                BadgeColumn::make('parent.title')
                    ->label('Parent')
                    ->toggleable()
                    ->sortable()
                    ->placeholder('None')
                    ->url(fn($record) => $record->parent ? route('filament.admin.resources.categories.edit', $record->parent->id) : null),
                BooleanColumn::make('active')
                    ->label('Active')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->url(fn($record) => route('filament.admin.resources.categories.edit', $record->slug))
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('order')
                    ->label('Order')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
