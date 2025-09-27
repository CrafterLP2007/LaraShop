<?php

namespace App\Admin\Resources\Roles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                BadgeColumn::make('permissions_count')
                    ->label('Permissions')
                    ->getStateUsing(fn($record) => $record->permissions->count() . ' Permissions')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->placeholder('No Permissions Assigned'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
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
