<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoyaltyReward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'points_required',
        'monetary_value',
        'image_url',
        'terms_conditions',
        'is_active',
        'stock_quantity',
        'expires_at',
        'redemption_count',
        'admin_notes',
    ];

    protected $casts = [
        'terms_conditions' => 'array',
        'monetary_value' => 'decimal:2',
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Scope to get only active rewards
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    })
                    ->where(function($q) {
                        $q->where('stock_quantity', -1)
                          ->orWhere('stock_quantity', '>', 0);
                    });
    }

    /**
     * Scope to get rewards by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Check if reward is available
     */
    public function isAvailable()
    {
        if (!$this->is_active) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if ($this->stock_quantity !== -1 && $this->stock_quantity <= 0) return false;
        return true;
    }

    /**
     * Get formatted terms and conditions
     */
    public function getFormattedTermsAttribute()
    {
        if (!$this->terms_conditions) return [];
        
        return is_array($this->terms_conditions) 
            ? $this->terms_conditions 
            : json_decode($this->terms_conditions, true) ?? [];
    }

    /**
     * Get category icon
     */
    public function getCategoryIconAttribute()
    {
        $icons = [
            'dining' => '🍽️',
            'accommodation' => '🏨',
            'wellness' => '💆',
            'entertainment' => '🎭',
            'transportation' => '🚗',
            'shopping' => '🛍️',
            'services' => '⭐',
        ];

        return $icons[$this->category] ?? '🎁';
    }

    /**
     * Get category color
     */
    public function getCategoryColorAttribute()
    {
        $colors = [
            'dining' => 'orange',
            'accommodation' => 'blue',
            'wellness' => 'green',
            'entertainment' => 'purple',
            'transportation' => 'red',
            'shopping' => 'pink',
            'services' => 'indigo',
        ];

        return $colors[$this->category] ?? 'gray';
    }

    /**
     * Increment redemption count
     */
    public function incrementRedemption()
    {
        $this->increment('redemption_count');
        
        if ($this->stock_quantity !== -1) {
            $this->decrement('stock_quantity');
        }
    }

    /**
     * Get available stock status
     */
    public function getStockStatusAttribute()
    {
        if ($this->stock_quantity === -1) {
            return 'Unlimited';
        } elseif ($this->stock_quantity > 10) {
            return 'Available (' . $this->stock_quantity . ')';
        } elseif ($this->stock_quantity > 0) {
            return 'Low Stock (' . $this->stock_quantity . ')';
        } else {
            return 'Out of Stock';
        }
    }
}
