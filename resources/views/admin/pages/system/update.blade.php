<x-filament-panels::page>
    <div class="space-y-6">
        @if($currentVersion !== $latestVersion)
            <x-filament::card class="bg-warning-50 border-warning-200 mb-4">
                <div class="flex items-center">
                    <x-heroicon-o-arrow-up-circle class="w-6 h-6 text-warning-500 mr-2" />
                    <span class="text-warning-700 font-medium">A new version is available!</span>
                </div>
            </x-filament::card>
        @else
            <x-filament::card class="border-success-200 mb-4">
                <div class="flex items-center">
                    <x-heroicon-o-check-circle class="w-6 h-6 text-success-500 mr-2" />
                    <span class="text-success-700 font-medium">You are on the newest version!</span>
                </div>
            </x-filament::card>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-filament::card>
                <h3 class="font-semibold">Current Version</h3>
                <p class="text-lg">{{ $currentVersion }}</p>
            </x-filament::card>
            <x-filament::card>
                <h3 class="font-semibold">Newest Version</h3>
                <p class="text-lg">{{ $latestVersion }}</p>
            </x-filament::card>
        </div>

        <x-filament::card>
            <h3 class="font-semibold mb-2">Changelogs</h3>
            <ul class="space-y-2">
                <li class="flex items-center">
                    <x-filament::icon name="heroicon-o-star" class="w-5 h-5 text-primary-500 mr-2"/>
                    <span>Feature: Neue Benutzerverwaltung</span>
                </li>
                <li class="flex items-center">
                    <x-filament::icon name="heroicon-o-bug-ant" class="w-5 h-5 text-success-500 mr-2"/>
                    <span>Fix: Fehler beim Login behoben</span>
                </li>
                <li class="flex items-center">
                    <x-filament::icon name="heroicon-o-bolt" class="w-5 h-5 text-warning-500 mr-2"/>
                    <span>Update: Performance verbessert</span>
                </li>
            </ul>
        </x-filament::card>

        <div class="flex items-center justify-center">
            <x-filament::button color="primary" icon="heroicon-o-arrow-path" wire:click="checkForUpdates">
                Nach Updates suchen
            </x-filament::button>
        </div>
    </div>
</x-filament-panels::page>
