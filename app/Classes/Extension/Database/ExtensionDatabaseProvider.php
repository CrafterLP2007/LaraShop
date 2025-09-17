<?php

namespace App\Classes\Extension\Database;

use App\Classes\Extension\Extension;
use App\Traits\WithExtensionMigrations;
use Artisan;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Provides database operations for an extension.
 *
 * Handles table naming and migration management for extension-specific tables.
 */
class ExtensionDatabaseProvider extends Model
{
    use WithExtensionMigrations;

    /**
     * The extension instance associated with this provider.
     *
     * @var Extension
     */
    protected Extension $instance;

    /**
     * The name of the database table for this extension.
     *
     * @var string
     */
    protected string $tableName;

    /**
     * Constructor sets up the extension instance and table name.
     *
     * @param Extension $instance The extension instance.
     * @param string $tableName Optional table name suffix.
     */
    public function __construct(Extension $instance, string $tableName = "")
    {
        parent::__construct();

        $this->instance = $instance;

        // Build the table name using the extension name and optional suffix.
        $tableSuffix = $tableName !== '' ? '_' . $tableName : '';
        $this->tableName = "extensions_" . strtolower($this->instance->getMetadata()['name']) . $tableSuffix;

        // Set the table for Eloquent operations.
        $this->table = $tableName;
    }

    /**
     * @throws Exception
     */
    public function setTable($table)
    {
        throw new Exception("This function is not allowed here");
    }
}
