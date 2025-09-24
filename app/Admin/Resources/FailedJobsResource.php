<?php

namespace App\Admin\Resources;

use App\Models\FailedJob;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use UnitEnum;

class FailedJobsResource extends Resource
{
    protected static ?string $model = FailedJob::class;
    protected static ?string $navigationLabel = 'Failed Jobs';
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static string | UnitEnum | null $navigationGroup = 'System';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable()->searchable(),
                TextColumn::make('connection')->label('Connection')->searchable(),
                TextColumn::make('queue')->label('Queue')->searchable(),
                TextColumn::make('payload')->label('Payload')->searchable()->limit(50),
                TextColumn::make('exception')->label('Exception')->searchable()->limit(50),
                TextColumn::make('failed_at')->label('Failed At')->dateTime()->sortable(),
            ])
            ->defaultSort('failed_at', 'desc')
            ->filters([
                SelectFilter::make('connection')
                    ->options(fn () => FailedJob::query()->distinct()->pluck('connection', 'connection')->toArray()),
                SelectFilter::make('queue')
                    ->options(fn () => FailedJob::query()->distinct()->pluck('queue', 'queue')->toArray()),
                Filter::make('failed_at')
                    ->form([
                        DatePicker::make('failed_from'),
                        DatePicker::make('failed_until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['failed_from'], fn($q) => $q->whereDate('failed_at', '>=', $data['failed_from']))
                            ->when($data['failed_until'], fn($q) => $q->whereDate('failed_at', '<=', $data['failed_until']));
                    })
            ])
            ->searchable(['id', 'connection', 'queue', 'payload', 'exception']);
    }
}
