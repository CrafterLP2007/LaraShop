<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PromocodeType;
use App\Exceptions\Promocode\PromocodeNotFoundException;
use App\Exceptions\Promocode\PromocodeLimitExceededException;

class Promocode extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'expires_at',
        'active_at',
        'usage_limit',
        'used_count',
        'product_ids',
        'user_ids',
        'max_count_per_user',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'active_at' => 'datetime',
        'active' => 'boolean',
        'product_ids' => 'array',
        'user_ids' => 'array',
        'type' => PromocodeType::class,
    ];

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

    /**
     * @throws PromocodeLimitExceededException
     * @throws PromocodeNotFoundException
     */
    public function apply(int $userId, int $productId): bool
    {
        if (!$this->isActive() || !$this->isValidForProduct($productId) || !$this->isValidForUser($userId) || !$this->canUserUsePromocode($userId)) {
            throw new PromocodeNotFoundException();
        }

        if (
            ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) ||
            (!$this->isUnlimitedPerUser() && $this->getUserUsageCount($userId) >= $this->max_count_per_user)
        ) {
            throw new PromocodeLimitExceededException();
        }

        $this->used_count++;
        $this->save();

        PromocodeUsage::create([
            'promocode_id' => $this->id,
            'user_id' => $userId,
            'used_at' => now(),
        ]);

        return true;
    }
}
