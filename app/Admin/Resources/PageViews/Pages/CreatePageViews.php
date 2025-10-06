<?php

namespace App\Admin\Resources\PageViews\Pages;

use App\Admin\Resources\PageViews\PageViewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePageViews extends CreateRecord
{
    protected static string $resource = PageViewsResource::class;
}
