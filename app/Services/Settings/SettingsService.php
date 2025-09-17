<?php

namespace App\Services\Settings;

use App\Models\Setting;
use Exception;
use Illuminate\Database\Eloquent\Model;

class SettingsService
{
    public function getSetting(string $key, ?Model $entity = null, bool $isEncrypted = false): mixed
    {
        try {
            $query = Setting::where('key', $key);

            if ($entity) {
                $query->where('entity_type', get_class($entity))
                    ->where('entity_id', $entity->id);
            } else {
                $query->whereNull('entity_type')
                    ->whereNull('entity_id');
            }

            $setting = $query->first();

            if (!$setting) {
                $setting = $this->setSetting($key, entity: $entity, isEncrypted: $isEncrypted);
            }

            if ($isEncrypted && $setting->value) {
                try {
                    return decrypt($setting->value);
                } catch (Exception) {
                    return $setting->value;
                }
            }

            if ($setting->value === null && !$entity) {
                return config($key);
            }

            return match ($setting->value) {
                'true', 1 => true,
                'false', 0 => false,
                default => $setting->value,
            };
        } catch (Exception) {
            return $entity ? null : config($key);
        }
    }

    public function setSetting(
        string $key,
        ?string $value = null,
        ?Model $entity = null,
        bool $isEncrypted = false,
        bool $updateIfExists = false
    ): Setting {
        $query = Setting::where('key', $key);

        if ($entity) {
            $query->where('entity_type', get_class($entity))
                ->where('entity_id', $entity->id);
        } else {
            $query->whereNull('entity_type')
                ->whereNull('entity_id');
        }

        $setting = $query->first();

        if (!$setting) {
            $setting = new Setting();
            $setting->key = $key;
            $setting->entity_type = $entity ? get_class($entity) : null;
            $setting->entity_id = $entity?->id;

            if ($value !== null) {
                $setting->value = $isEncrypted ? encrypt($value) : $value;
            } elseif (!$entity) {
                $setting->value = $isEncrypted ? encrypt(config($key)) : config($key);
            }

            $setting->save();
        } elseif ($updateIfExists) {
            $setting->value = $isEncrypted ? encrypt($value) : $value;
            $setting->save();
        }

        return $setting;
    }

    public function updateSetting(
        string $key,
        ?string $value,
        ?Model $entity = null,
        bool $isEncrypted = false
    ): Setting {
        return $this->setSetting($key, $value, $entity, $isEncrypted, true);
    }

    public function updateSettings(array $settings, ?Model $entity = null): void
    {
        foreach ($settings as $key => $value) {
            $this->updateSetting($key, $value, $entity);
        }
    }

    public function deleteSetting(string $key, ?Model $entity = null): bool
    {
        $query = Setting::where('key', $key);

        if ($entity) {
            $query->where('entity_type', get_class($entity))
                ->where('entity_id', $entity->id);
        } else {
            $query->whereNull('entity_type')
                ->whereNull('entity_id');
        }

        return (bool) $query->delete();
    }
}
