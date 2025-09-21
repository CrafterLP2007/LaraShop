<?php

namespace App\Admin\Pages\System;

use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Log;
use UnitEnum;

class LogsPage extends Page
{
    protected static ?string $title = 'Logs';
    protected static string|UnitEnum|null $navigationGroup = 'System';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Logs';
    protected static ?int $navigationSort = 3;
    protected string $view = 'admin.pages.system.logs';

    public array $logEntries = [];
    public int $limit = 200;
    public bool $canLoadMore = true;

    public function mount()
    {
        $this->logEntries = $this->getLogLines();
    }

    public function getLogLines(): array
    {
        $logFile = storage_path('logs/laravel.log');
        if (!file_exists($logFile)) {
            return [];
        }

        $allLines = file($logFile, FILE_IGNORE_NEW_LINES);
        $totalLines = count($allLines);

        $start = max(0, $totalLines - $this->limit);
        $lines = array_slice($allLines, $start, $this->limit);

        $this->canLoadMore = $start > 0;

        return $lines;
    }

    public function loadMore()
    {
        $this->limit += 200;
        $this->logEntries = $this->getLogLines();
    }
}
