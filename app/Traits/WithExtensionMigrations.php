<?php

namespace App\Traits;

use Artisan;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Trait for extension database migration operations.
 *
 * Provides methods to find migration files, run migrations, and roll back migrations
 * for extension-specific tables.
 */
trait WithExtensionMigrations
{
    /**
     * Finds the migration file for the current extension table.
     *
     * @return string Path to the migration file.
     * @throws Exception If no migration file is found.
     */
    private function findMigrationFile(): string
    {
        $migrationDir = extensions_path($this->instance->getMetadata()['name'], "migrations/");
        foreach (glob($migrationDir . "*.php") as $file) {
            if (str_contains($file, $this->tableName)) {
                return $file;
            }
        }

        throw new Exception("No migrations found for table {$this->tableName}");
    }

    /**
     * Runs the migration for the extension table.
     *
     * @throws Exception If migration file is not found.
     */
    public function migrate(): void
    {
        $migrationFile = $this->findMigrationFile();
        $relativePath = str_replace(base_path() . '/', '', $migrationFile);

        Artisan::call('migrate', [
            '--path' => $relativePath,
            '--force' => true,
        ]);

        $output = Artisan::output();
        Log::info("Migration executed for {$this->tableName}: " . trim($output));
    }

    /**
     * Rolls back the migration for the extension table.
     *
     * @throws Exception If migration file is not found.
     */
    public function rollback(): void
    {
        $migrationFile = $this->findMigrationFile();
        $relativePath = str_replace(base_path() . '/', '', $migrationFile);

        Artisan::call('migrate:rollback', [
            '--path' => $relativePath,
            '--force' => true,
        ]);

        $output = Artisan::output();
        Log::info("Rollback executed for {$this->tableName}: " . trim($output));
    }
}
