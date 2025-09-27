<?php

namespace App\Admin\Resources\Users;

use App\Admin\Resources\Users\Pages\CreateUsers;
use App\Admin\Resources\Users\Pages\EditUsers;
use App\Admin\Resources\Users\Pages\ListUsers;
use App\Admin\Resources\Users\Schemas\UsersForm;
use App\Admin\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;
    protected static string | UnitEnum | null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $recordTitleAttribute = 'Users';

    public static function form(Schema $schema): Schema
    {
        return UsersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUsers::route('/create'),
            'edit' => EditUsers::route('/{record}/edit'),
        ];
    }
}
