<?php

namespace App\Services\Extensions;

use App\Attributes\ExtensionMeta;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use RuntimeException;

class ExtensionDiscoveryService
{
    private string $extensionPath;
    private array $cacheConfig;

    public function __construct(string $extensionPath)
    {
        $this->extensionPath = $extensionPath;
        $this->cacheConfig = config('extension.cache');
    }

    /**
     * Discover all extensions in the specified directory and cache the result.
     *
     * @return array
     */
    public function discover(): array
    {
        $files = File::allFiles($this->extensionPath);
        $signature = md5(implode('|', array_map(fn($f) => $f->getFilename() . $f->getMTime(), $files)));
        $cacheKey = ($this->cacheConfig['prefix'] ?? 'extension_') . $signature;
        $cacheEnabled = $this->cacheConfig['enabled'] ?? true;
        $cacheDuration = $this->cacheConfig['duration'] ?? 3600;

        if ($cacheEnabled && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $extensions = [];
        $identifiers = [];
        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $fileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                $className = "Extensions\\{$fileName}\\{$fileName}";

                require_once $file->getPathname();

                if (class_exists($className)) {
                    $reflection = new ReflectionClass($className);
                    $attributes = $reflection->getAttributes(ExtensionMeta::class);
                    if (!empty($attributes)) {
                        $meta = $attributes[0]->newInstance();
                        $identifier = strtoupper(substr($meta->author, 0, 1)) . '_' . strtoupper(substr($meta->name, 0, 1));
                        if (isset($identifiers[$identifier])) {
                            $identifiers[$identifier][] = $className;
                            throw new RuntimeException(
                                'Duplicate identifier found: ' . $identifier .
                                '. Classes: ' . implode(', ', $identifiers[$identifier])
                            );
                        }
                        $identifiers[$identifier] = [$className];
                        $extensions[] = [
                            'identifier' => $identifier,
                            'name' => $meta->name,
                            'description' => $meta->description,
                            'version' => $meta->version,
                            'author' => $meta->author,
                            'url' => $meta->url,
                            'class' => $className,
                        ];
                    }
                }
            }
        }

        if ($cacheEnabled) {
            Cache::put($cacheKey, $extensions, $cacheDuration);
        }

        return $extensions;
    }

    /**
     * Get the fully qualified class name from the file path.
     *
     * @param string $file
     * @return string|null
     */
    private function getClassNameFromFile(string $file): ?string
    {
        $contents = file_get_contents($file);
        if (preg_match('/namespace\s+([^;]+);/', $contents, $nsMatch) &&
            preg_match('/class\s+([A-Za-z0-9_]+)/', $contents, $classMatch)) {
            $namespace = trim($nsMatch[1]);
            $className = trim($classMatch[1]);
            if (str_starts_with($namespace, config('extension.namespace'))) {
                return $namespace . '\\' . $className;
            }
        }
        return null;
    }
}
