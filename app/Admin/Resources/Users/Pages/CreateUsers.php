<?php

namespace App\Admin\Resources\Users\Pages;

use App\Admin\Resources\Users\UsersResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Tapp\FilamentCountryCodeField\Forms\Components\CountryCodeSelect;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;
}
