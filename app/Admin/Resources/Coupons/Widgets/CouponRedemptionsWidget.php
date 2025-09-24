<?php

namespace App\Admin\Resources\Coupons\Widgets;

use App\Models\Promocode;
use App\Models\PromocodeUsage;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Collection;

class CouponRedemptionsWidget extends Widget
{
    public Promocode $record;

    protected string $view = 'admin.resources.coupons.widgets.redemptions';
    public ?int $selectedRedemptionId = null;
    public ?PromocodeUsage $selectedRedemption = null;

    public function selectRedemption(int $id): void
    {
        $this->selectedRedemptionId = $id;
        $this->selectedRedemption = PromocodeUsage::whereId($id)->firstOrFail();
    }

    public function getRedemptions(): Collection|array
    {
        return $this->record->redemptions()->with('user')->get();
    }
}
