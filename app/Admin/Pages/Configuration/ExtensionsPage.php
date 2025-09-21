<?php

namespace App\Admin\Pages\Configuration;

use App\Models\Extension;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Collection;
use UnitEnum;

class ExtensionsPage extends Page
{
    protected static ?string $title = 'Extensions';
    protected static string|UnitEnum|null $navigationGroup = 'Configurations';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationLabel = 'Extensions';
    protected ?string $subheading = 'Manage your application extensions';
    protected static ?int $navigationSort = 1;
    protected string $view = 'admin.pages.system.extensions';

    public string $search = '';
    public ?string $selectedType = 'all';

    public function getFilteredExtensions()
    {
        $extensions = Extension::query()
            ->when($this->search, fn($query) =>
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('author', 'like', "%{$this->search}%")
            )
            ->when($this->selectedType !== 'all', fn($query) =>
            $query->where('type', $this->selectedType)
            )
            ->get();

        return $extensions;
    }
}
