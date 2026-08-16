<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Check if discount is valid (active, not expired, not exceeded usage)
     */
    public function isValid(): bool
    {
        if (!$this->is_active) return false;
        if ($this->expires_at && Carbon::now()->gt($this->expires_at)) return false;
        if ($this->max_uses && $this->used_count >= $this->max_uses) return false;
        return true;
    }

    /**
     * Apply discount to a given amount (USD)
     */
    public function applyTo($amount): float
    {
        if ($this->type === 'percentage') {
            return $amount * (1 - ($this->value / 100));
        } else { // fixed
            return max(0, $amount - $this->value);
        }
    }

    /**
     * Increment used count
     */
    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }
}
