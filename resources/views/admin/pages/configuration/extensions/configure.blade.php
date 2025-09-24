<x-filament-panels::page>
    <x-filament::form wire:submit="save">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">
            Speichern
        </x-filament::button>
    </x-filament::form>
</x-filament-panels::page>
