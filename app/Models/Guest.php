<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class Guest extends Authenticatable
{
    use Notifiable, Syncable;

    protected $table = 'core1_guest';
    protected $primaryKey = 'guestID';

    protected $fillable = [
        'guest_email',
        'guest_name',
        'guest_photo',
        'guest_address',
        'guest_mobile',
        'guest_password',
        'guest_birthday',
        'guest_status',
        'membership_tier',
        'loyalty_points',
        'total_spent',
        'membership_since',
        'last_activity',
    ];

    protected $casts = [
        'guest_birthday' => 'date',
        'loyalty_points' => 'integer',
        'total_spent' => 'decimal:2',
        'membership_since' => 'datetime',
        'last_activity' => 'datetime',
    ];

    protected $hidden = [
        'guest_password', 'remember_token',
    ];

    // Use guest_password for authentication instead of default 'password'
    public function getAuthPassword()
    {
        return $this->guest_password;
    }

    /**
     * Get the membership tier details
     */
    public function membershipTier()
    {
        return $this->belongsTo(MembershipTier::class, 'membership_tier', 'tier_name');
    }

    /**
     * Get loyalty points from existing system
     */
    public function getLoyaltyPointsAttribute()
    {
        $existingPoints = guestloyaltypoints::where('guestID', $this->guestID)->value('points_balance');
        
        // If no existing points, use the new system's points
        if ($existingPoints === null) {
            return $this->attributes['loyalty_points'] ?? 0;
        }
        
        return (int) $existingPoints;
    }

    /**
     * Set loyalty points in both systems
     */
    public function setLoyaltyPointsAttribute($value)
    {
        $this->attributes['loyalty_points'] = $value;
        
        // Also update the existing system
        guestloyaltypoints::updateOrCreate(
            ['guestID' => $this->guestID],
            ['points_balance' => (int) $value]
        );
    }

    /**
     * Get loyalty transactions from new system
     */
    public function loyaltyTransactions()
    {
        return $this->hasMany(LoyaltyTransaction::class, 'guestID');
    }

    /**
     * Get current membership benefits
     */
    public function getCurrentBenefitsAttribute()
    {
        return $this->membershipTier ? $this->membershipTier->formatted_benefits : [];
    }

    /**
     * Get food discount percentage
     */
    public function getFoodDiscountAttribute()
    {
        return $this->membershipTier ? $this->membershipTier->food_discount : 0;
    }

    /**
     * Get room discount percentage
     */
    public function getRoomDiscountAttribute()
    {
        return $this->membershipTier ? $this->membershipTier->room_discount : 0;
    }

    /**
     * Get points multiplier
     */
    public function getPointsMultiplierAttribute()
    {
        return $this->membershipTier ? $this->membershipTier->points_multiplier : 1;
    }

    /**
     * Get bonus points for tier
     */
    public function getBonusPointsAttribute()
    {
        return $this->membershipTier ? $this->membershipTier->bonus_points : 0;
    }

    /**
     * Check if guest can upgrade to next tier
     */
    public function canUpgradeTier()
    {
        if (!$this->membershipTier) return false;
        
        $nextTier = $this->membershipTier->next_tier;
        if (!$nextTier) return false;
        
        return $this->loyalty_points >= $nextTier->min_points || 
               $this->total_spent >= $nextTier->min_spent;
    }

    /**
     * Update membership tier based on points and spending
     */
    public function updateMembershipTier()
    {
        $newTier = MembershipTier::active()
            ->where(function($query) {
                $query->where('min_points', '<=', $this->loyalty_points)
                      ->orWhere('min_spent', '<=', $this->total_spent);
            })
            ->orderBy('min_points', 'desc')
            ->first();

        if ($newTier && $newTier->tier_name !== $this->membership_tier) {
            $oldTier = $this->membership_tier;
            $this->membership_tier = $newTier->tier_name;
            $this->save();

            // Add bonus points for tier upgrade
            if ($newTier->bonus_points > 0) {
                $this->addLoyaltyPoints($newTier->bonus_points, 'bonus', null, "Tier upgrade to {$newTier->tier_name}");
            }

            return [
                'upgraded' => true,
                'old_tier' => $oldTier,
                'new_tier' => $newTier->tier_name,
                'bonus_points' => $newTier->bonus_points
            ];
        }

        return ['upgraded' => false];
    }

    /**
     * Add loyalty points
     */
    public function addLoyaltyPoints($points, $type = 'earned', $reference = null, $description = '')
    {
        // Update points in both systems
        $currentPoints = $this->loyalty_points;
        $newPoints = $currentPoints + $points;
        $this->loyalty_points = $newPoints;
        $this->last_activity = now();
        $this->save();

        LoyaltyTransaction::create([
            'guestID' => $this->guestID,
            'transaction_type' => $type,
            'points_change' => $points,
            'reference_type' => $reference ? get_class($reference) : null,
            'reference_id' => $reference ? $reference->getKey() : null,
            'description' => $description,
            'transaction_date' => now(),
            'points_balance_after' => $newPoints,
        ]);

        // Check for tier upgrade
        $this->updateMembershipTier();
    }

    /**
     * Redeem loyalty points
     */
    public function redeemLoyaltyPoints($points, $reference = null, $description = '')
    {
        if ($this->loyalty_points < $points) {
            return false;
        }

        // Update points in both systems
        $currentPoints = $this->loyalty_points;
        $newPoints = $currentPoints - $points;
        $this->loyalty_points = $newPoints;
        $this->last_activity = now();
        $this->save();

        LoyaltyTransaction::create([
            'guestID' => $this->guestID,
            'transaction_type' => 'redeemed',
            'points_change' => -$points,
            'reference_type' => $reference ? get_class($reference) : null,
            'reference_id' => $reference ? $reference->getKey() : null,
            'description' => $description,
            'transaction_date' => now(),
            'points_balance_after' => $newPoints,
        ]);

        return true;
    }

    /**
     * Add spending and calculate points
     */
    public function addSpending($amount, $reference = null, $description = '')
    {
        $this->total_spent += $amount;
        $this->last_activity = now();
        $this->save();

        // Calculate points based on multiplier
        $pointsEarned = intval($amount * $this->points_multiplier);
        
        if ($pointsEarned > 0) {
            $this->addLoyaltyPoints($pointsEarned, 'earned', $reference, $description ?: "Earned {$pointsEarned} points from ₱{$amount} purchase");
        }

        return $pointsEarned;
    }
}
