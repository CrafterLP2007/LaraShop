<?php

namespace App\Admin\Resources\Extensions;

use App\Admin\Resources\Extensions\Pages\CreateExtensions;
use App\Admin\Resources\Extensions\Pages\EditExtensions;
use App\Admin\Resources\Extensions\Pages\ListExtensions;
use App\Admin\Resources\Extensions\Pages\EditExtension;
use App\Admin\Resources\Extensions\Schemas\ExtensionsForm;
use App\Models\Extension;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ExtensionsResource extends Resource
{
    protected static ?string $model = Extension::class;
    protected static string | UnitEnum | null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPuzzlePiece;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Extensions';

    public static function form(Schema $schema): Schema
    {
        return ExtensionsForm::configure($schema);
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
            'index' => ListExtensions::route('/'),
            'edit' => EditExtension::route('/{record}'),
        ];
    }
}
