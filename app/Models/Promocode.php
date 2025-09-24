<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PromocodeType;
use App\Exceptions\Promocode\PromocodeNotFoundException;
use App\Exceptions\Promocode\PromocodeLimitExceededException;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promocode extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'expires_at',
        'active_at',
        'usage_limit',
        'product_ids',
        'user_ids',
        'max_count_per_user',
        'active',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'active_at' => 'datetime',
        'active' => 'boolean',
        'product_ids' => 'array',
        'user_ids' => 'array',
        'type' => PromocodeType::class,
    ];

    public function redemptions(): HasMany|Promocode
    {
        return $this->hasMany(PromocodeUsage::class, 'promocode_id');
    }

    public function isActive(): bool
    {
        $now = now();
        return ($this->active_at === null || $this->active_at <= $now)
            && ($this->expires_at === null || $this->expires_at > $now)
            && ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function isValidForProduct(int $productId): bool
    {
        return empty($this->product_ids) || in_array($productId, $this->product_ids);
    }

    public function isValidForUser(int $userId): bool
    {
        return empty($this->user_ids) || in_array($userId, $this->user_ids);
    }

    public function isUnlimitedPerUser(): bool
    {
        return $this->max_count_per_user === -1;
    }

    public function getUserUsageCount(int $userId): int
    {
        return PromocodeUsage::where('promocode_id', $this->id)
            ->where('user_id', $userId)
            ->count();
    }

    public function canUserUsePromocode(int $userId): bool
    {
        if ($this->isUnlimitedPerUser()) {
            return true;
        }
        return $this->getUserUsageCount($userId) < $this->max_count_per_user;
    }
}
