@php
    $redemptions = $this->getRedemptions()
        ->sortByDesc(fn($redemption) => $redemption->used_at)
        ->groupBy(fn($redemption) => $redemption->used_at?->format('Y-m-d'));
    $firstDate = array_key_first($redemptions->toArray());
@endphp

<div class="flex gap-6">
    <x-filament::section class="min-w-full">
        <div class="flex-1 relative">
            <div class="absolute top-0 bottom-0 left-4 w-0.5 bg-gray-300 dark:bg-gray-700"></div>

            @foreach ($redemptions as $date => $dayRedemptions)
                <div class="flex items-start mb-8 last:mb-0">
                    <div class="relative mr-4">
                        <div class="w-8 h-8 bg-white dark:bg-gray-900 rounded-full absolute"></div>
                        <div class="w-8 h-8 bg-primary-600/20 border-2 border-primary-600 rounded-full shadow-sm relative z-10">
                            <x-filament::icon
                                icon="heroicon-o-calendar"
                                class="w-5 h-5 text-primary-600 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20"
                            />
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}
                            </span>
                            @if($date === $firstDate)
                                <x-filament::badge color="primary" size="sm">
                                    Latest
                                </x-filament::badge>
                            @endif
                        </div>

                        <div class="grid gap-3">
                            @foreach ($dayRedemptions as $redemption)
                                <x-filament::card
                                    wire:click="selectRedemption({{ $redemption->id }})"
                                    :class="'cursor-pointer transition hover:border-primary-500 ' . ($selectedRedemptionId === $redemption->id ? 'ring-2 ring-primary-500' : '')"
                                >
                                    <div class="flex items-center gap-4">
                                        <x-filament::avatar
                                            :src="$redemption->user?->getFilamentAvatarUrl()"
                                            :alt="($redemption->user->first_name ?? '') . ' ' . ($redemption->user->last_name ?? '')"
                                            class="flex-shrink-0"
                                            size="lg"
                                        >
                                            @if(!$redemption->user?->avatar)
                                                <span class="text-lg font-medium">
                                                    {{ mb_substr($redemption->user->first_name ?? '', 0, 1) }}{{ mb_substr($redemption->user->last_name ?? '', 0, 1) }}
                                                </span>
                                            @endif
                                        </x-filament::avatar>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-base font-semibold truncate text-gray-900 dark:text-gray-100">
                                                {{ $redemption->user->first_name ?? '' }} {{ $redemption->user->last_name ?? '' }}
                                            </div>
                                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                <x-filament::icon name="heroicon-m-clock" class="w-4 h-4" />
                                                {{ $redemption->used_at?->format('H:i') ?? '-' }} Uhr
                                            </div>
                                            @if($redemption->order)
                                                <div class="mt-2 px-3 py-1 rounded bg-primary-50 dark:bg-primary-900/40 text-xs text-primary-700 dark:text-primary-300 flex items-center gap-2">
                                                    <x-filament::icon name="heroicon-m-shopping-bag" class="w-4 h-4" />
                                                    Bestellung:
                                                    <a href="{{ $redemption->order->getFilamentUrl() }}" class="underline hover:text-primary-900 dark:hover:text-primary-200" target="_blank">
                                                        #{{ $redemption->order->id }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </x-filament::card>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>

    <div class="min-w-full">
        <div class="sticky top-20">
            <x-filament::section class="h-96">
                @if($selectedRedemption)
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium">Details</h3>
                        <div class="space-y-2">
                            <p><span class="font-medium">Benutzer:</span> {{ $selectedRedemption->user->first_name }} {{ $selectedRedemption->user->last_name }}</p>
                            <p><span class="font-medium">Datum:</span> {{ $selectedRedemption->used_at->format('d.m.Y H:i') }}</p>
                            @if($selectedRedemption->order)
                                <p><span class="font-medium">Bestellnummer:</span> #{{ $selectedRedemption->order->id }}</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="h-full flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <x-filament::icon
                                icon="heroicon-o-information-circle"
                                class="w-8 h-8 mx-auto mb-2"
                            />
                            <p>Noch keine Einlösung ausgewählt</p>
                        </div>
                    </div>
                @endif
            </x-filament::section>
        </div>
    </div>
</div>
