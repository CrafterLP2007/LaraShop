<?php

namespace App\Admin\Resources\Users\Pages;

use App\Admin\Resources\Users\UsersResource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Tapp\FilamentCountryCodeField\Forms\Components\CountryCodeSelect;

class EditUsers extends EditRecord
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
