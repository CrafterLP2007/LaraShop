<x-filament-panels::page>
    <div class="flex gap-6 items-start lg:flex-row flex-col">
        <x-filament::card class="lg:w-1/3 w-full self-start">
            <h2 class="text-lg font-bold mb-2">Category tree</h2>
            <p class="text-sm text-gray-500 mb-4">Here you can see the nested categories and their hierarchy.</p>
            @include('admin.resources.categories.components.category-tree', ['categories' => $categoryTree])
        </x-filament::card>
        <div class="lg:w-2/3 w-full">
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>
