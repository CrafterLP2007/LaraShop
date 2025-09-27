<?php

namespace App\Admin\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextCOlumn::make('phone_number')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('zip')
                    ->label('ZIP')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('country')
                    ->label('Country')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->label('City')
                    ->searchable()
                    ->sortable(),
                BooleanCOlumn::make('two_factor_enabled')
                    ->label('2FA')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->colors([
                        'primary',
                        'danger' => fn (BooleanColumn $column): bool => !$column->getState(),
                    ]),
                BooleanColumn::make('disabled')
                    ->label('Disabled')
                    ->sortable(),
                TextColumn::make('email_verified_at')
                    ->label('Verified')
                    ->dateTime('M j, Y')
                    ->placeholder("Unverified")
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
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
