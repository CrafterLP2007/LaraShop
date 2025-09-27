<x-filament-panels::page>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="search"
                        wire:model.live="search"
                        placeholder="Nach Namen oder Autor suchen..."
                        prefix-icon="heroicon-m-magnifying-glass"
                        class="block w-full border-gray-300 rounded-lg"
                    />
                </x-filament::input.wrapper>

                <x-filament::input.wrapper>
                    <x-filament::input.select
                        wire:model.live="selectedType"
                        class="block w-full border-gray-300 rounded-lg"
                        placeholder="Choose type..."
                    >
                        <option value="all">All types</option>
                        <option value="gateway">Gateways</option>
                        <option value="shipping">Shipping</option>
                        <option value="other">Other</option>
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>
            <div>
                <x-filament::button icon="heroicon-o-arrow-up-tray">
                    Upload Extension
                </x-filament::button>
            </div>
        </div>
    </div>

    @if($this->getFilteredExtensions()->count() === 0)
        <p class="text-center"></p>
        <div class="text-center text-gray-500">
            No extensions
            found {{ $this->search ? 'for "' . $this->search . '"' : '' }} {{ $this->selectedType !== 'all' ? 'in type "' . str($this->selectedType)->title() . '"' : '' }}
            .
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach($this->getFilteredExtensions() as $extension)
                <x-filament::card>
                    <div class="flex items-start gap-4">
                        <div @class([
                        'rounded-lg p-2',
                        'bg-blue-300 text-blue-800' => $extension->type == 'other',
                        'bg-success-300 text-success-800' => $extension->type == 'gateway',
                        'bg-warning-300 text-warning-800' => $extension->type == 'shipping',
                    ])>
                            @if($extension->type == 'other')
                                <x-filament::icon icon="heroicon-o-cube" class="w-6 h-6"/>
                            @elseif($extension->type == 'gateway')
                                <x-filament::icon icon="heroicon-o-currency-dollar" class="w-6 h-6"/>
                            @elseif($extension->type == 'shipping')
                                <x-filament::icon icon="heroicon-o-shopping-bag" class="w-6 h-6"/>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h3 class="text-base font-medium tracking-tight">
                                {{ $extension->name }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $extension->description }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-gray-500">
                                    <x-filament::icon icon="heroicon-m-tag" class="h-4 w-4"/>
                                    <span>Version</span>
                                </div>
                                <div class="font-medium">{{ $extension->version }}</div>
                            </div>

                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-gray-500">
                                    <x-filament::icon icon="heroicon-m-user" class="h-4 w-4"/>
                                    <span>Author</span>
                                </div>
                                <div class="font-medium">{{ $extension->author }}</div>
                            </div>

                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-gray-500">
                                    <x-filament::icon icon="heroicon-m-cube" class="h-4 w-4"/>
                                    <span>Type</span>
                                </div>
                                <x-filament::badge>
                                    {{ str($extension->type)->title() }}
                                </x-filament::badge>
                            </div>

                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-gray-500">
                                    <x-filament::icon icon="heroicon-m-link" class="h-4 w-4"/>
                                    <span>URL</span>
                                </div>
                                @if($extension->url)
                                    <x-filament::link href="{{ $extension->url }}" target="_blank">
                                        {{ str($extension->url)->limit(20) }}
                                    </x-filament::link>
                                @else
                                    <span class="text-gray-400">Keine URL</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <x-filament::button
                            icon="heroicon-o-cog"
                            :href="route('filament.admin.resources.extensions.edit', ['record' => $extension->identifier])"
                            wire:navigate
                            tag="a"
                            class="w-full mt-6"
                    >
                        Configure
                    </x-filament::button>
                </x-filament::card>
            @endforeach
        </div>
    @endif
</x-filament-panels::page>
