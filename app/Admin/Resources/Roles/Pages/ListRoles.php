<?php

namespace App\Admin\Resources\Roles\Pages;

use App\Admin\Resources\Roles\RolesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
