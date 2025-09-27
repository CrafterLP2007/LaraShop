<?php

namespace App\Admin\Resources\Roles;

use App\Admin\Resources\Roles\Pages\CreateRoles;
use App\Admin\Resources\Roles\Pages\EditRoles;
use App\Admin\Resources\Roles\Pages\ListRoles;
use App\Admin\Resources\Roles\Schemas\RolesForm;
use App\Admin\Resources\Roles\Tables\RolesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use UnitEnum;

class RolesResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static string | UnitEnum | null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $recordTitleAttribute = 'Roles';

    public static function form(Schema $schema): Schema
    {
        return RolesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
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
            'index' => ListRoles::route('/'),
            'create' => CreateRoles::route('/create'),
            'edit' => EditRoles::route('/{record}/edit'),
        ];
    }
}
