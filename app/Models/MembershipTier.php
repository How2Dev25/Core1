<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'tier_name',
        'min_points',
        'min_spent',
        'food_discount',
        'room_discount',
        'points_multiplier',
        'bonus_points',
        'benefits',
        'badge_color',
        'is_active',
    ];

    protected $casts = [
        'benefits' => 'array',
        'min_spent' => 'decimal:2',
        'food_discount' => 'decimal:2',
        'room_discount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get guests with this membership tier
     */
    public function guests()
    {
        return $this->hasMany(Guest::class, 'membership_tier', 'tier_name');
    }

    /**
     * Scope to get only active tiers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the next tier
     */
    public function getNextTierAttribute()
    {
        return static::active()
            ->where('min_points', '>', $this->min_points)
            ->orderBy('min_points')
            ->first();
    }

    /**
     * Get formatted benefits
     */
    public function getFormattedBenefitsAttribute()
    {
        $benefits = [];
        
        if ($this->food_discount > 0) {
            $benefits[] = "{$this->food_discount}% Food Discount";
        }
        
        if ($this->room_discount > 0) {
            $benefits[] = "{$this->room_discount}% Room Discount";
        }
        
        if ($this->points_multiplier > 1) {
            $benefits[] = "{$this->points_multiplier}x Points Multiplier";
        }
        
        if ($this->bonus_points > 0) {
            $benefits[] = "+{$this->bonus_points} Bonus Points";
        }
        
        if ($this->benefits) {
            $benefits = array_merge($benefits, $this->benefits);
        }
        
        return $benefits;
    }
}
