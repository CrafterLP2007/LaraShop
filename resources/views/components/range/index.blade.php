@props([
    'uuid' => 'pengublade-range-' . str()->uuid(),
    'current' => 0,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'hint' => null,
    'showValue' => false,
])

<div x-data="{ currentVal: {{ $current }} }"
     class="flex w-full items-center gap-4 text-neutral-600 dark:text-neutral-300">
    <label for="{{ $uuid }}" class="sr-only">
        {{ $slot }}
    </label>
    <input x-model="currentVal" id="{{ $uuid }}" type="range" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"
        {{ $attributes->twMerge('h-2 w-full appearance-none bg-neutral-50 focus:outline-black dark:bg-neutral-900 dark:focus:outline-white [&::-moz-range-thumb]:size-4 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:border-none [&::-moz-range-thumb]:bg-black active:[&::-moz-range-thumb]:scale-110 [&::-moz-range-thumb]:dark:bg-white [&::-webkit-slider-thumb]:size-4 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:border-none [&::-webkit-slider-thumb]:bg-black active:[&::-webkit-slider-thumb]:scale-110 [&::-webkit-slider-thumb]:dark:bg-white [&::-moz-range-thumb]:rounded-full [&::-webkit-slider-thumb]:rounded-full rounded-full') }}/>

    @if($showValue)
        <span class="w-10 text-lg font-bold text-neutral-900 dark:text-white" x-text="currentVal"></span>
    @endif
</div>

@if($hint)
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
@endif

@if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
    <div class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
@endif
