<?php

namespace App\Admin\Pages\System;

use App\Classes\Settings;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Gate;
use UnitEnum;
use App\Models\Setting;

class SettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'Settings';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?int $navigationSort = 2;
    protected string $view = 'admin.pages.system.settings';
    protected static ?string $slug = 'settings';

    public ?array $data = [];

    public function mount(): void
    {
        $setting_values = [];
        foreach (Settings::settings() as $group => $settings) {
            foreach ($settings as $setting) {
                $setting_values[$setting['name']] = config("settings.{$setting['name']}", $setting['default'] ?? null);
            }
        }

        $this->form->fill($setting_values);
    }

    public function form(Schema $schema): Schema
    {
        $tabs = [];

        foreach (Settings::settings() as $key => $categories) {
            $tab = Tab::make($key)
                ->label(ucwords(str_replace('-', ' ', $key)))
                ->schema(function () use ($categories, $key) {
                    $inputs = [];
                    foreach ($categories as $setting) {
                        $inputs[] = TextInput::make('settings.' . $setting['name'])->label($setting['label'] ?? ucwords(str_replace(['-', '_'], ' ', $setting['name'])))
                            ->type($setting['type'] ?? 'text')
                            ->default($setting['default'] ?? null)
                            ->required($setting['required'] ?? false)
                            ->helperText($setting['helperText'] ?? null)
                            ->columnSpanFull()
                            ->placeholder($setting['placeholder'] ?? null)
                            ->rules($setting['rules'] ?? [])
                            ->dehydrated()
                            ->reactive();
                    }
                    if ($key === 'theme') {
                        array_unshift($inputs, Actions::make([
                            Action::make('resetColors')
                                ->label('Reset Colors')
                                ->color('danger')
                                ->requiresConfirmation()
                                ->action(fn () => $this->resetColors()),
                        ]));
                        if (count($inputs) > 1) {
                            $inputs[0] = Group::make([
                                $inputs[1]->columnSpan(3),
                                $inputs[0],
                            ])->columns(4)->columnSpanFull();
                            unset($inputs[1]);
                        }
                    }

                    return $inputs;
                });

            $tabs[] = $tab;
        }

        return $schema
            ->components([
                Form::make([
                    Tabs::make('Tabs')
                        ->tabs($tabs)
                        ->persistTabInQueryString(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        //Gate::authorize('has-permission', 'admin.settings.update');

        $data = $this->form->getState();

        $settings = Setting::where('entity_type', null)
            ->whereIn('key', array_keys($data))
            ->get()
            ->keyBy('key');

        foreach ($data as $key => $value) {
            $avSetting = (object) collect(Settings::settings())->flatten(1)->firstWhere('name', $key);
            $avSetting->value = $settings[$key]->value ?? $avSetting->default ?? null;

            if ($value !== $avSetting->value || (($avSetting->database_type ?? 'string') === 'boolean' && (bool) $value !== (bool) $avSetting->value)) {
                if ($setting = $settings[$key] ?? null) {
                    $setting->update([
                        'value' => $value,
                        'type' => $avSetting->database_type ?? 'string',
                        'encrypted' => $avSetting->encrypted ?? false,
                    ]);
                } else {
                    Setting::create([
                        'key' => $key,
                        'value' => $value,
                        'type' => $avSetting->database_type ?? 'string',
                        'encrypted' => $avSetting->encrypted ?? false,
                    ]);
                }
            }
        }

        Notification::make()
            ->title('Saved successfully!')
            ->success()
            ->send();
    }

    public function resetColors(): void
    {
        Gate::authorize('has-permission', 'admin.settings.update');

        $colorSettings = [];
        foreach (Settings::settings() as $group => $settings) {
            foreach ($settings as $setting) {
                if (($setting['type'] ?? '') === 'color') {
                    $colorSettings[$setting['name']] = $setting['default'] ?? '';
                }
            }
        }

        $currentData = $this->form->getState();
        foreach ($colorSettings as $key => $defaultValue) {
            $currentData[$key] = $defaultValue;
        }
        $this->form->fill($currentData);

        Notification::make()
            ->title('Colors has been reset!')
            ->success()
            ->send();
    }
}
