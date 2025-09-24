<?php

namespace App\Admin\Resources\Coupons;

use App\Admin\Resources\Coupons\Pages\CreateCoupons;
use App\Admin\Resources\Coupons\Pages\EditCoupons;
use App\Admin\Resources\Coupons\Pages\ListCoupons;
use App\Admin\Resources\Coupons\Pages\ViewCoupon;
use App\Admin\Resources\Coupons\Schemas\CouponsForm;
use App\Admin\Resources\Coupons\Tables\CouponsTable;
use App\Models\Promocode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CouponsResource extends Resource
{
    protected static ?string $model = Promocode::class;
    protected static string | UnitEnum | null $navigationGroup = 'Shop';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Coupons';
    protected static ?string $recordTitleAttribute = 'Coupons';

    public static function form(Schema $schema): Schema
    {
        return CouponsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CouponsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCoupons::route('/'),
            'create' => CreateCoupons::route('/create'),
            'edit' => EditCoupons::route('/{record}/edit'),
            'view' => ViewCoupon::route('/{record}'),
        ];
    }
}
