<?php

namespace App\Admin\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class RolesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->unique()
                    ->maxLength(20)
                    ->columnSpanFull(),

                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->options(Permission::all()->pluck('name', 'id'))
                    ->columns(4)
                    ->bulkToggleable()
                    ->searchable()
                    ->noSearchResultsMessage('No permissions found.')
                    ->columnSpanFull(),
            ]);
    }
}
