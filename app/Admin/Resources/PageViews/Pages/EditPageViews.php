<?php

namespace App\Admin\Resources\PageViews\Pages;

use App\Admin\Resources\PageViews\PageViewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPageViews extends EditRecord
{
    protected static string $resource = PageViewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
