<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePrice extends Model
{
    protected $fillable = [
        'course_id',
        'original_price',
        'discounted_price',
        'currency',
        'discount_ends_at',
    ];

    protected $casts = [
        'discount_ends_at' => 'datetime',
        'original_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function isDiscountActive(): bool
    {
        if (is_null($this->discounted_price)) {
            return false;
        }
        if ($this->discount_ends_at && now()->gt($this->discount_ends_at)) {
            return false;
        }
        return true;
    }

    public function getEffectivePriceAttribute(): float
    {
        if ($this->isDiscountActive()) {
            return floatval($this->discounted_price);
        }
        return floatval($this->original_price ?? 0);
    }

    public function getSavingsPercentAttribute(): int
    {
        if (!$this->isDiscountActive() || !$this->original_price || $this->original_price <= 0) {
            return 0;
        }
        return round((($this->original_price - $this->discounted_price) / $this->original_price) * 100);
    }
}
