<?php

namespace App\Models;

use App\Attributes\ExtensionMeta;
use App\Classes\Extension\GatewayExtension;
use App\Classes\Extension\ShippingExtension;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ReflectionClass;
use Sushi\Sushi;

class Extension extends Model
{
    use Sushi;

    private array $config;

    const TYPE_GATEWAY = 'gateway';
    const TYPE_SHIPPING = 'shipping';
    const TYPE_OTHER = 'other';

    public function __construct()
    {
        parent::__construct();
        $this->config = config('extension');
    }

    /**
     * @throws Exception
     */
    private function getExtensionMetadata(object $instance): ?array
    {
        $reflection = new ReflectionClass($instance);
        $attributes = $reflection->getAttributes(ExtensionMeta::class);

        if (empty($attributes)) {
            throw new Exception(
                "Extension {$reflection->getName()} has no ExtensionMeta attribute defined"
            );
        }

        $meta = $attributes[0]->newInstance();
        $type = $instance instanceof GatewayExtension
            ? self::TYPE_GATEWAY
            : ($instance instanceof ShippingExtension
                ? self::TYPE_SHIPPING
                : self::TYPE_OTHER);

        if (!$type) {
            throw new Exception(
                "Extension {$reflection->getName()} has an invalid type"
            );
        }

        return [
            'identifier' => strtoupper(substr($meta->author, 0, 1)) . '_' . strtoupper(substr($meta->name, 0, 1)),
            'name' => $meta->name,
            'description' => $meta->description,
            'version' => $meta->version,
            'author' => $meta->author,
            'url' => $meta->url,
            'type' => $type,
            'class' => get_class($meta),
        ];
    }

    public function getRows(): array
    {
        $rows = [];
        $loadedNames = [];
        $extensionPath = $this->config['path'];
        $cacheConfig = $this->config['cache'];
        $cacheEnabled = $cacheConfig['enabled'] ?? true;
        $cacheDuration = $cacheConfig['duration'] ?? 60;
        $cachePrefix = $cacheConfig['prefix'] ?? 'extension_';

        $files = File::allFiles($extensionPath);
        $signature = md5(implode('|', array_map(fn($f) => $f->getFilename() . $f->getMTime(), $files)));
        $cacheKey = $cachePrefix . $signature;

        /*
        if ($cacheEnabled && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        */

        foreach ($files as $extension) {
            if ($extension->getExtension() === 'php') {
                $fileName = pathinfo($extension->getFilename(), PATHINFO_FILENAME);
                $className = "Extensions\\{$fileName}\\{$fileName}";

                require_once $extension->getPathname();

                if (class_exists($className)) {
                    try {
                        /** @var \App\Classes\Extension\Extension $instance */
                        $instance = new $className();
                        $meta = $this->getExtensionMetadata($instance);
                        $instance->boot($meta, []);

                        $uniqueName = $meta['author'] . '_' . $fileName;

                        if (in_array($uniqueName, $loadedNames, true)) {
                            continue;
                        }
                        $loadedNames[] = $uniqueName;

                        $rows[] = $this->getExtensionMetadata($instance);
                    } catch (Exception $e) {
                        Log::error("Failed to load extension {$className}: " . $e->getMessage());
                    }
                }
            }
        }

        if ($cacheEnabled) {
            Cache::put($cacheKey, $rows, $cacheDuration * 60);
        }

        return $rows;
    }

    public function getClass(): GatewayExtension|ShippingExtension|Extension|null
    {
        $extension = collect($this->getRows())->firstWhere('name', $this->name);
        if ($extension) {
            $className = $this->config['namespace'] . "{$extension['name']}\\{$extension['name']}";
            return new $className();
        }
        return null;
    }

    public static function reload(): void
    {
        Cache::forget('extensions');

        $instance = new self();
        $rows = $instance->getRows();
        $instance->setRows($rows);
        $instance->save();
    }
}
