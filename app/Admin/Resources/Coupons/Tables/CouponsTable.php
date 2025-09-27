<?php

namespace App\Admin\Resources\Coupons\Tables;

use App\Enums\PromocodeType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->alignCenter()
                    ->hidden(),

                TextColumn::make('code')
                    ->label('Code')
                    ->sortable()
                    ->searchable()
                    ->copyable(),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => PromocodeType::PERCENTAGE->value,
                        'success' => PromocodeType::FIXED->value,
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('value')
                    ->label('Value')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 2) . ' €'),

                TextColumn::make('active_at')
                    ->label('Active From')
                    ->dateTime(),

                TextColumn::make('expires_at')
                    ->label('Expires At')
                    ->dateTime(),

                BooleanColumn::make('active')
                    ->label('Active'),

                TextColumn::make('usage_limit')
                    ->label('Usage Limit')
                    ->formatStateUsing(fn($state) => $state === -1 ? '∞' : $state),

                TextColumn::make('max_count_per_user')
                    ->label('Max Per User')
                    ->formatStateUsing(fn($state) => $state === -1 ? '∞' : $state),

                TextColumn::make('used_count')
                    ->label('Used Count')
                    ->alignCenter(),

                TagsColumn::make('product_ids')
                    ->label('Products')
                    ->limit(3),

                TagsColumn::make('user_ids')
                    ->label('Users')
                    ->limit(3),
            ])
            ->filters([

            ])
            ->recordActions([
                ViewAction::make()
                    ->url(fn($record) => route('filament.admin.resources.coupons.view', ['record' => $record])),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
