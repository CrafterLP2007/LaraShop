<?php

namespace App\Admin\Resources\Categories\Pages;

use App\Admin\Resources\Categories\CategoriesResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoriesResource::class;
    protected string $view = 'admin.resources.categories.pages.list';

    public function getCategoryTree()
    {
        $categories = Category::orderBy('order')->get();

        $buildTree = function ($parentId = null) use ($categories, &$buildTree) {
            return $categories
                ->where('parent_id', $parentId)
                ->map(function ($category) use ($buildTree) {
                    return [
                        'category' => $category,
                        'children' => $buildTree($category->id),
                    ];
                });
        };

        return $buildTree();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function render(): View
    {
        return view($this->view, [
            'categoryTree' => $this->getCategoryTree(),
            'this' => $this,
        ])->layout('filament-panels::components.layout.index');
    }
}
