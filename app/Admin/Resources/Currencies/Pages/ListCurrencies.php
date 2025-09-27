<?php

namespace App\Admin\Resources\Currencies\Pages;

use App\Admin\Resources\Currencies\CurrenciesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCurrencies extends ListRecords
{
    protected static string $resource = CurrenciesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
