<?php

namespace App\Admin\Resources\Extensions\Pages;

use App\Admin\Resources\Extensions\ExtensionsResource;
use App\Models\Extension;
use Filament\Actions\CreateAction;
use Filament\Panel;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Collection;

class ListExtensions extends ListRecords
{
    protected static string $resource = ExtensionsResource::class;
    protected string $view = 'admin.pages.configuration.extensions.list';
    public string $search = '';
    public ?string $selectedType = 'all';

    public function getFilteredExtensions(): array|Collection
    {
        return Extension::query()
            ->when($this->search, fn($query) =>
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('author', 'like', "%{$this->search}%")
            )
            ->when($this->selectedType !== 'all', fn($query) =>
            $query->where('type', $this->selectedType)
            )
            ->get();
    }
}
