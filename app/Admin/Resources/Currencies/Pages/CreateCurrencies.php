<?php

namespace App\Admin\Resources\Currencies\Pages;

use App\Admin\Resources\Currencies\CurrenciesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCurrencies extends CreateRecord
{
    protected static string $resource = CurrenciesResource::class;
}
