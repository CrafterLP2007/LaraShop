<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Sushi\Sushi;

class Extension extends Model
{
    use Sushi;

    public function getRows(): array
    {
        $rows = [];
        $extensionPath = config('settings.extensions_path');
        $extensions = File::allFiles($extensionPath);

        foreach ($extensions as $extension) {
            $fileName = pathinfo($extension->getFilename(), PATHINFO_FILENAME);
            $className = "Extensions\\{$fileName}\\{$fileName}";

            if (class_exists($className) && $extension->getExtension() === 'php') {
                try {
                    $instance = new $className($extension->getPathname());
                    if (method_exists($instance, 'metadata')) {
                        $metadata = $instance->metadata();
                        if ($metadata['name'] === class_basename($className)) {
                            $rows[] = [
                                'name' => $metadata['name'],
                                'author' => $metadata['author'] ?? null,
                                'version' => $metadata['version'] ?? null,
                                'path' => $extension->getPathname(),
                            ];
                        }
                    }
                } catch (Exception $e) {
                    Log::error("Failed to load extension {$className}: " . $e->getMessage());
                }
            }
        }

        return $rows;
    }

    protected function getClassNameFromFile(string $filePath): string
    {
        $path = realpath($filePath);
        $namespace = 'Modules\\Order\\Extensions\\';
        $relativePath = str_replace(realpath(config('settings.extensions_path')) . DIRECTORY_SEPARATOR, '', $path);
        $relativePath = trim($relativePath, DIRECTORY_SEPARATOR);
        $relativePath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath);
        return $namespace . str_replace([DIRECTORY_SEPARATOR, '.php'], ['\\', ''], $relativePath);
    }

    public function getClass(): ?\App\Classes\Extension
    {
        $extension = collect($this->getRows())->firstWhere('name', $this->name);
        if ($extension) {
            $className = $this->getClassNameFromFile($extension['path']);
            return new $className($extension['path']);
        }

        return null;
    }
}
