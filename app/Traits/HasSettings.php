<?php

namespace App\Traits;

use App\Models\Setting;
use App\Services\Settings\SettingsService;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSettings
{
    /**
     * Instance of the settings service.
     * Lazy-loaded through the service container when needed.
     */
    protected ?SettingsService $settingsService = null;

    /**
     * Get the settings relationship for the entity.
     * Uses polymorphic relationship to link settings to any model.
     *
     * @return MorphMany
     */
    public function settings(): MorphMany
    {
        return $this->morphMany(Setting::class, 'entity');
    }

    /**
     * Get a setting value for the entity.
     * Returns null if setting doesn't exist, or config value for global settings.
     *
     * @param string $key The setting key to retrieve
     * @param bool $isEncrypted Whether the value is stored encrypted
     * @return mixed The setting value
     */
    public function getSetting(string $key, bool $isEncrypted = false): mixed
    {
        return $this->getSettingsService()->getSetting($key, $this, $isEncrypted);
    }

    /**
     * Set a new setting value for the entity.
     * Creates a new setting if it doesn't exist.
     *
     * @param string $key The setting key
     * @param mixed $value The value to store
     * @param bool $isEncrypted Whether to encrypt the value
     * @return Setting
     */
    public function setSetting(string $key, mixed $value, bool $isEncrypted = false): Setting
    {
        return $this->getSettingsService()->setSetting($key, $value, $this, $isEncrypted);
    }

    /**
     * Update an existing setting value for the entity.
     * Creates the setting if it doesn't exist.
     *
     * @param string $key The setting key
     * @param mixed $value The new value
     * @param bool $isEncrypted Whether to encrypt the value
     * @return Setting
     */
    public function updateSetting(string $key, mixed $value, bool $isEncrypted = false): Setting
    {
        return $this->getSettingsService()->updateSetting($key, $value, $this, $isEncrypted);
    }

    /**
     * Update multiple settings at once for the entity.
     * Processes each setting through updateSetting().
     *
     * @param array $settings Associative array of key => value pairs
     */
    public function updateSettings(array $settings): void
    {
        $this->getSettingsService()->updateSettings($settings, $this);
    }

    /**
     * Delete a setting for the entity.
     * Returns true if setting was deleted, false if it didn't exist.
     *
     * @param string $key The setting key to delete
     * @return bool Success status
     */
    public function deleteSetting(string $key): bool
    {
        return $this->getSettingsService()->deleteSetting($key, $this);
    }

    /**
     * Get the settings service instance.
     * Lazy-loads the service from the container if not already instantiated.
     *
     * @return SettingsService
     */
    protected function getSettingsService(): SettingsService
    {
        if (!$this->settingsService) {
            $this->settingsService = app(SettingsService::class);
        }
        return $this->settingsService;
    }
}
