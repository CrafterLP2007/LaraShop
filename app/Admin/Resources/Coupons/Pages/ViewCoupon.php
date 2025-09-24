<?php

namespace App\Admin\Resources\Coupons\Pages;

use App\Admin\Resources\Coupons\CouponsResource;
use App\Admin\Resources\Coupons\Widgets\CouponRedemptionsWidget;
use Filament\Resources\Pages\ViewRecord;

class ViewCoupon extends ViewRecord
{
    protected static string $resource = CouponsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CouponRedemptionsWidget::class,
        ];
    }
}
