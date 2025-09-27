<?php

namespace App\Admin\Resources\Roles\Pages;

use App\Admin\Resources\Roles\RolesResource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class EditRoles extends EditRecord
{
    protected static string $resource = RolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
