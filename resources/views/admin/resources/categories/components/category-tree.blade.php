@if($categories->isNotEmpty())
    <ul class="space-y-2">
        @foreach($categories as $item)
            <li
                x-data="{
                    open: JSON.parse(localStorage.getItem('cat-open-{{ $item['category']->id }}')) || false,
                    toggle() {
                        this.open = !this.open;
                        localStorage.setItem('cat-open-{{ $item['category']->id }}', JSON.stringify(this.open));
                    }
                }"
                class="pl-4"
            >
                <div class="flex items-center gap-2 py-2">
                    @if($item['children']->isNotEmpty())
                        <button @click="toggle()" class="focus:outline-none">
                            <x-filament::icon
                                icon="heroicon-o-chevron-right"
                                class="h-4 w-4 text-gray-400 transition-transform duration-200"
                                x-bind:class="open ? 'rotate-90' : 'rotate-0'"
                            />
                        </button>
                    @else
                        <span class="w-4"></span>
                    @endif
                    <x-filament::icon icon="heroicon-o-folder" class="h-5 w-5 text-gray-400"/>
                    <a href="{{ route('filament.admin.resources.categories.edit', $item['category']->id) }}"
                       wire:navigate class="font-medium hover:text-blue-500 hover:underline">
                        {{ $item['category']->title }}
                    </a>
                    @if(!$item['category']->active)
                        <x-filament::badge color="danger" size="sm">
                            <div class="flex items-center gap-1">
                                <x-filament::icon icon="heroicon-o-eye-slash" class="h-4 w-4 text-gray-400"
                                                  title="Inactive"/>
                                Hidden
                            </div>
                        </x-filament::badge>
                    @endif
                </div>
                @if($item['children']->isNotEmpty())
                    <div
                        x-show="open"
                        x-collapse
                    >
                        @include('admin.resources.categories.components.category-tree', ['categories' => $item['children']])
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
@else
    <p class="text-sm text-gray-500 text-center mt-12">No categories found.</p>
@endif
