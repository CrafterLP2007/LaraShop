<x-filament-panels::page>
    <div class="space-y-6">
        <!-- System & App Infos Card -->
        <x-filament::card class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <x-filament::icon icon="heroicon-o-cpu-chip" class="w-8 h-6 text-primary-600" />
                        <div>
                            <h2 class="font-semibold">PHP-Version</h2>
                            <p>{{ phpversion() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mb-2">
                        <x-filament::icon icon="heroicon-o-device-phone-mobile" class="w-5 h-5 text-primary-600" />
                        <div>
                            <h2 class="font-semibold">Betriebssystem</h2>
                            <p>{{ PHP_OS }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mb-2">
                        <x-filament::icon icon="heroicon-o-server" class="w-5 h-5 text-primary-600" />
                        <div>
                            <h2 class="font-semibold">Server-Software</h2>
                            <p>{{ $_SERVER['SERVER_SOFTWARE'] ?? 'Unbekannt' }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <x-filament::icon icon="heroicon-o-fire" class="w-5 h-5 text-primary-600" />
                        <div>
                            <h2 class="font-semibold">Laravel-Version</h2>
                            <p>{{ Illuminate\Foundation\Application::VERSION }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mb-2">
                        <x-filament::icon icon="heroicon-o-adjustments-horizontal" class="w-5 h-5 text-primary-600" />
                        <div>
                            <h2 class="font-semibold">App Umgebung</h2>
                            <p>{{ app()->environment() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mb-2">
                        <x-filament::icon icon="heroicon-o-clock" class="w-5 h-5 text-primary-600" />
                        <div>
                            <h2 class="font-semibold">Zeitzone</h2>
                            <p>{{ config('app.timezone') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </x-filament::card>

        <!-- Composer, Theme, Cronjobs Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-filament::card class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-document" class="w-5 h-5 text-primary-600" />
                <div>
                    <h3 class="font-semibold mb-1">Composer-Pakete</h3>
                    <a href="https://yourdomain.tld/composer.lock" target="_blank" class="text-primary-600 underline">composer.lock</a>
                </div>
            </x-filament::card>
            <x-filament::card class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-paint-brush" class="w-5 h-5 text-primary-600" />
                <div>
                    <h3 class="font-semibold mb-1">Filament Theme</h3>
                    <div class="text-gray-700">{{ theme() }}</div>
                </div>
            </x-filament::card>
            <x-filament::card class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-clock" class="w-5 h-5 text-primary-600" />
                <div>
                    <h3 class="font-semibold mb-1">Cronjobs</h3>
                    <div class="text-gray-700">
                        @if(isset($cronjobs) && count($cronjobs) > 0)
                            <ul class="list-disc ml-4">
                                @foreach($cronjobs as $job)
                                    <li>{{ $job }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span>Keine Cronjobs gefunden.</span>
                        @endif
                    </div>
                </div>
            </x-filament::card>
        </div>

        <!-- Cache Card -->
        <x-filament::card class="p-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-trash" class="w-5 h-5 text-primary-600" />
                <div>
                    <h3 class="font-semibold mb-1">Cache-Größe</h3>
                    <div class="text-gray-700">
                        {{ number_format(10000 / 1024, 2) }} KB
                    </div>
                </div>
            </div>
            <button type="submit" class="filament-button bg-primary-600 text-white px-4 py-2 rounded">
                Cache leeren
            </button>
        </x-filament::card>
    </div>
</x-filament-panels::page>
