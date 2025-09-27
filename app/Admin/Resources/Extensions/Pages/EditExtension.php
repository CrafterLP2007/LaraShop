<?php

namespace App\Admin\Resources\Extensions\Pages;

use App\Admin\Resources\Extensions\ExtensionsResource;
use App\Models\ExtensionOption;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class EditExtension extends EditRecord
{
    protected static string $resource = ExtensionsResource::class;

    public function mount($record): void
    {
        parent::mount($record);

        $optionValues = ExtensionOption::where('extension_identifier', $this->record->identifier)
            ->pluck('value', 'key')
            ->toArray();

        $formState = [];
        foreach ($this->getConfiguration() as $config) {
            $formState[$config['name']] = $optionValues[$config['name']] ?? $config['value'] ?? '';
        }

        $this->form->fill($formState);
    }

    public function form(Schema $schema): Schema
    {
        $fields = [];
        foreach ($this->getConfiguration() as $config) {
            switch ($config['type']) {
                case 'text':
                    $fields[] = TextInput::make($config['name'])
                        ->label($config['label'])
                        ->placeholder($config['placeholder'])
                        ->required($config['required'] ?? false)
                        ->helperText($config['description'] ?? '')
                        ->disabled(false);
                    break;
                case 'password':
                    $fields[] = TextInput::make($config['name'])
                        ->password()
                        ->revealable()
                        ->label($config['label'])
                        ->placeholder($config['placeholder'])
                        ->required($config['required'] ?? false)
                        ->helperText($config['description'] ?? '')
                        ->disabled(false);
                    break;
                case 'textarea':
                    $fields[] = Textarea::make($config['name'])
                        ->label($config['label'])
                        ->placeholder($config['placeholder'])
                        ->required($config['required'] ?? false)
                        ->helperText($config['description'] ?? '')
                        ->disabled(false);
                    break;
                case 'checkbox':
                    $fields[] = Checkbox::make($config['name'])
                        ->label($config['label'])
                        ->helperText($config['description'] ?? '')
                        ->disabled(false);
                    break;
            }
        }

        return $schema->schema($fields);
    }

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        foreach ($this->getConfiguration() as $config) {
            ExtensionOption::updateOrCreate(
                [
                    'extension_identifier' => $this->record->identifier,
                    'key' => $config['name'],
                ],
                [
                    'value' => $this->form->getState()[$config['name']] ?? null,
                ]
            );
        }
    }

    public function getConfiguration(): array
    {
        return $this->record->getConfiguration();
    }
}
