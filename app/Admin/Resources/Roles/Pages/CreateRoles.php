<?php

namespace App\Admin\Resources\Roles\Pages;

use App\Admin\Resources\Roles\RolesResource;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class CreateRoles extends CreateRecord
{
    protected static string $resource = RolesResource::class;
}
