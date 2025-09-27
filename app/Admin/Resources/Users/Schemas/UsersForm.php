<?php

namespace App\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Tapp\FilamentCountryCodeField\Forms\Components\CountryCodeSelect;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('first_name')->label('First Name')->required()->maxLength(50),
            TextInput::make('last_name')->label('Last Name')->required()->maxLength(50),
            TextInput::make('email')->label('Email')->email()->required()->maxLength(255)->unique(),
            TextInput::make('phone_number')->label('Phone Number')->required(),
            TextInput::make('address')->label('Address')->required(),
            TextInput::make('zip')->label('ZIP Code')->required(),
            TextInput::make('city')->label('City')->required(),
            CountryCodeSelect::make('country')->label('Country')->required(),
            Select::make('roles')->label('Roles')->multiple()->relationship('roles', 'name')->preload()->required()->columnSpanFull(),
            TextInput::make('password')->label('Password')->helperText('At least 8 characters. The password can be revealed.')->password()->required()->minLength(8)->columnSpanFull()->revealable(),
            Checkbox::make('disabled')->label('Disabled')->helperText('Disable the user. They will not be able to log in.')->default(false),
            Checkbox::make('email_verified_at')->label('Verified')->helperText('Marks the email as verified.')->columnSpanFull()->default(false)->afterStateUpdated(function (bool $state, callable $set) {
                if ($state) {
                    $set('email_verified_at', now());
                }
            }),
        ]);
    }
}
