<?php

namespace App\Admin\Pages\Configuration\Extensions;

use App\Models\Extension;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ExtensionConfigurationPage extends Page
{
    protected static ?string $title = 'Configure Extension';
    protected static ?string $navigationLabel = 'Configure Extension';
    protected string $view = 'admin.pages.configuration.extensions.configure';

}
