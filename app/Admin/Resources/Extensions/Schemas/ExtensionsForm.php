<?php

namespace App\Admin\Resources\Extensions\Schemas;

use Filament\Schemas\Schema;

class ExtensionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
