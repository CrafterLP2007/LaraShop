<?php

namespace App\Admin\Resources\Coupons\Pages;

use App\Admin\Resources\Coupons\CouponsResource;
use App\Models\Product;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class EditCoupons extends EditRecord
{
    protected static string $resource = CouponsResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('type')
                ->label('Discount Type')
                ->helperText('Choose between percentage or fixed amount discount')
                ->options([
                    'percentage' => 'Percentage',
                    'fixed' => 'Fixed Amount',
                ])
                ->default('percentage')
                ->required()
                ->native(false)
                ->reactive(),

            TextInput::make('value')
                ->label('Discount Value')
                ->helperText('Enter the discount amount')
                ->numeric()
                ->required()
                ->reactive()
                ->suffix(fn($get) => $get('type') === 'percentage' ? '%' : ($get('type') === 'fixed' ? '€' : '')),

            DateTimePicker::make('active_at')
                ->label('Start Date')
                ->helperText('When should the coupon become active')
                ->default(now())
                ->required()
                ->native(false),

            DateTimePicker::make('expires_at')
                ->label('Expiry Date')
                ->helperText('When should the coupon expire')
                ->required()
                ->native(false),

            TextInput::make('usage_limit')
                ->label('Total Usage Limit')
                ->helperText('Maximum total redemptions allowed')
                ->numeric()
                ->default(-1)
                ->nullable(),

            TextInput::make('max_count_per_user')
                ->label('Per User Limit')
                ->helperText('Maximum uses per user')
                ->numeric()
                ->default(-1)
                ->nullable(),

            Select::make('users')
                ->label('Eligible Users')
                ->helperText('Restrict coupon to specific users')
                ->multiple()
                ->searchable()
                ->options(
                    User::query()
                        ->when(User::exists(), function ($query) {
                            return $query->get()->mapWithKeys(function ($user) {
                                $displayName = $user->first_name . ' ' . $user->last_name;
                                return [$user->id => trim($displayName) ?: 'Unknown User'];
                            });
                        }, function () {
                            return collect();
                        })
                ),

            Select::make('products')
                ->label('Eligible Products')
                ->helperText('Restrict coupon to specific products')
                ->multiple()
                ->searchable()
                ->options(function () {
                    return Product::all()->pluck('name', 'id');
                }),

            Checkbox::make('active')
                ->label('Active Status')
                ->default(true),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
