<?php

namespace App\Classes\Extension;

use App\Attributes\ExtensionMeta;
use App\Classes\Extension\Database\ExtensionDatabaseProvider;
use App\Models\Order;
use Exception;
use ReflectionClass;

/**
 * Abstract base class for all payment or service extensions.
 *
 * Provides a unified interface for extension metadata, order operations,
 * and configuration management. All custom extensions should extend this class
 * and implement the required abstract methods.
 */
abstract class Extension
{
    /**
     * Stores metadata about the extension, such as name, version, author, etc.
     * This is typically set during the boot process.
     * @var array
     */
    private array $metadata;

    /**
     * Stores the configuration values loaded from the config file.
     * Can be used by the extension to customize its behavior.
     * @var array
     */
    private array $config = [];

    /**
     * Initializes the extension with metadata and configuration.
     * This method should be called when the extension is loaded.
     * After setting metadata and config, it calls the onBoot hook for further initialization.
     *
     * @param array $metadata Metadata for the extension (name, version, author, etc.).
     * @param array $config Optional configuration values for the extension.
     */
    final public function boot(array $metadata, array $config = []): void
    {
        $this->metadata = $metadata;
        $this->config = $config;

        // Calls the hook for additional initialization logic in child classes.
        $this->onBoot();
    }

    /**
     * Hook method for child classes to implement custom boot logic.
     * This method is called after metadata and config are set.
     * Override this in your extension if you need custom initialization.
     */
    public function onBoot() {}

    /**
     * Returns a database provider instance for this extension.
     * The provider can be used to manage extension-specific database tables,
     * including migrations and queries.
     *
     * @param string $table Optional table name suffix for the extension table.
     * @return ExtensionDatabaseProvider Instance for database operations.
     */
    public function getDatabaseProvider(string $table = ""): ExtensionDatabaseProvider
    {
        return new ExtensionDatabaseProvider($this, $table);
    }

    /**
     * Returns an array of configuration options required by the extension.
     * Implement this method in your extension to define which config fields are needed.
     *
     * @return array List of configuration option definitions.
     */
    public abstract function options(): array;

    /**
     * Returns the metadata for this extension.
     *
     * Metadata includes information such as name, version, author, etc.
     *
     * @return array Extension metadata.
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * Returns the current configuration values for the extension.
     *
     * This array contains all settings that were provided during boot
     * and can be used to customize the extension's behavior.
     *
     * @return array Extension configuration values.
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}
