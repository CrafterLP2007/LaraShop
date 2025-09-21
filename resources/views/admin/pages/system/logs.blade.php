<x-filament-panels::page>
    <x-filament::card>
        <div wire:loading class="absolute inset-0 flex items-center justify-center bg-gray-900/50 rounded-lg z-20">
            <x-filament::loading-indicator class="w-7 h-7"/>
        </div>

        <div class="bg-gray-900 rounded-lg">
            <div
                x-ref="logContent"
                class="max-h-[600px] overflow-auto p-4 font-mono text-sm"
                x-init="$el.scrollTop = $el.scrollHeight"
                @scroll="
                        if ($event.target.scrollTop === 0) {
                            $wire.loadMore()
                        }
                    "
            >
                @if($canLoadMore)
                    <div class="text-gray-400 text-center mb-2">Nach oben scrollen für mehr Einträge...</div>
                @endif

                @forelse($logEntries as $entry)
                    <div class="text-gray-100 whitespace-pre-wrap">{{ $entry }}</div>
                @empty
                    <div class="text-gray-400">Keine Log-Einträge gefunden.</div>
                @endforelse
            </div>
        </div>
    </x-filament::card>
</x-filament-panels::page>
