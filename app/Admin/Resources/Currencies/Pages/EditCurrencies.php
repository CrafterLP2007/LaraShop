<?php

namespace App\Admin\Resources\Currencies\Pages;

use App\Admin\Resources\Currencies\CurrenciesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCurrencies extends EditRecord
{
    protected static string $resource = CurrenciesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
