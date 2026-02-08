<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\LoyaltyTransaction;
use App\Models\MembershipTier;
use App\Models\LoyaltyReward;

class LoyaltyService
{
    /**
     * Apply food discount based on guest membership tier
     */
    public function applyFoodDiscount(Guest $guest, $originalAmount)
    {
        $discountPercentage = $guest->food_discount;
        $discountAmount = $originalAmount * ($discountPercentage / 100);
        $finalAmount = $originalAmount - $discountAmount;

        return [
            'original_amount' => $originalAmount,
            'discount_percentage' => $discountPercentage,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'membership_tier' => $guest->membership_tier,
        ];
    }

    /**
     * Apply room discount based on guest membership tier
     */
    public function applyRoomDiscount(Guest $guest, $originalAmount)
    {
        $discountPercentage = $guest->room_discount;
        $discountAmount = $originalAmount * ($discountPercentage / 100);
        $finalAmount = $originalAmount - $discountAmount;

        return [
            'original_amount' => $originalAmount,
            'discount_percentage' => $discountPercentage,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'membership_tier' => $guest->membership_tier,
        ];
    }

    /**
     * Process food order and award points
     */
    public function processFoodOrder(Guest $guest, $orderAmount, $order = null)
    {
        // Apply discount first
        $discountInfo = $this->applyFoodDiscount($guest, $orderAmount);
        
        // Add spending and calculate points
        $pointsEarned = $guest->addSpending(
            $discountInfo['final_amount'], 
            $order, 
            "Food order: Earned points from ₱{$discountInfo['final_amount']} purchase"
        );

        return [
            'discount_info' => $discountInfo,
            'points_earned' => $pointsEarned,
            'new_balance' => $guest->loyalty_points,
            'membership_tier' => $guest->membership_tier,
        ];
    }

    /**
     * Process room booking and award points
     */
    public function processRoomBooking(Guest $guest, $bookingAmount, $booking = null)
    {
        // Apply discount first
        $discountInfo = $this->applyRoomDiscount($guest, $bookingAmount);
        
        // Add spending and calculate points
        $pointsEarned = $guest->addSpending(
            $discountInfo['final_amount'], 
            $booking, 
            "Room booking: Earned points from ₱{$discountInfo['final_amount']} purchase"
        );

        return [
            'discount_info' => $discountInfo,
            'points_earned' => $pointsEarned,
            'new_balance' => $guest->loyalty_points,
            'membership_tier' => $guest->membership_tier,
        ];
    }

    /**
     * Get guest loyalty summary
     */
    public function getLoyaltySummary(Guest $guest)
    {
        $currentTier = $guest->membershipTier;
        $nextTier = $currentTier ? $currentTier->next_tier : null;
        
        // Calculate progress to next tier
        $progressToNextTier = null;
        if ($nextTier) {
            $pointsNeeded = max(0, $nextTier->min_points - (int) $guest->loyalty_points);
            $spendingNeeded = max(0, $nextTier->min_spent - (float) $guest->total_spent);
            
            $pointsProgress = min(100, ((int) $guest->loyalty_points / $nextTier->min_points) * 100);
            $spendingProgress = min(100, ((float) $guest->total_spent / $nextTier->min_spent) * 100);
            
            $progressToNextTier = [
                'tier_name' => $nextTier->tier_name,
                'points_needed' => $pointsNeeded,
                'spending_needed' => $spendingNeeded,
                'points_progress' => $pointsProgress,
                'spending_progress' => $spendingProgress,
                'can_upgrade' => $guest->canUpgradeTier(),
            ];
        }

        // Get recent transactions
        $recentTransactions = $guest->loyaltyTransactions()
            ->with('guest')
            ->orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();

        return [
            'current_tier' => [
                'name' => $guest->membership_tier,
                'points' => (int) $guest->loyalty_points,
                'total_spent' => (float) $guest->total_spent,
                'benefits' => $guest->current_benefits,
                'badge_color' => $currentTier ? $currentTier->badge_color : '#CD7F32',
            ],
            'next_tier' => $progressToNextTier,
            'recent_transactions' => $recentTransactions,
            'stats' => [
                'total_points_earned' => $guest->loyaltyTransactions()->earned()->sum('points_change'),
                'total_points_redeemed' => abs($guest->loyaltyTransactions()->redeemed()->sum('points_change')),
                'total_bonus_points' => $guest->loyaltyTransactions()->bonus()->sum('points_change'),
                'membership_since' => $guest->membership_since,
                'last_activity' => $guest->last_activity,
            ],
        ];
    }

    /**
     * Get available rewards for redemption
     */
    public function getAvailableRewards()
    {
        return LoyaltyReward::active()
            ->get()
            ->map(function ($reward) {
                return [
                    'id' => $reward->id,
                    'name' => $reward->name,
                    'description' => $reward->description,
                    'category' => $reward->category,
                    'points_required' => $reward->points_required,
                    'monetary_value' => $reward->monetary_value,
                    'image_url' => $reward->image_url,
                    'terms_conditions' => $reward->formatted_terms,
                    'stock_status' => $reward->stock_status,
                    'expires_at' => $reward->expires_at,
                ];
            })
            ->toArray();
    }

    /**
     * Redeem points for rewards
     */
    public function redeemPoints(Guest $guest, $points, $rewardId, $description = '')
    {
        $reward = LoyaltyReward::find($rewardId);
        
        if (!$reward) {
            return [
                'success' => false,
                'message' => 'Reward not found',
            ];
        }

        if (!$reward->isAvailable()) {
            return [
                'success' => false,
                'message' => 'Reward is not available',
            ];
        }

        if ($guest->loyalty_points < $points) {
            return [
                'success' => false,
                'message' => 'Insufficient points',
                'current_balance' => $guest->loyalty_points,
                'points_needed' => $points,
            ];
        }

        if ($guest->redeemLoyaltyPoints($points, null, $description ?: "Redeemed {$reward->name} for {$points} points")) {
            // Increment redemption count and update stock
            $reward->incrementRedemption();

            return [
                'success' => true,
                'points_redeemed' => $points,
                'new_balance' => $guest->loyalty_points,
                'reward' => $reward->name,
                'remaining_stock' => $reward->stock_quantity === -1 ? 'Unlimited' : $reward->stock_quantity,
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to redeem points',
        ];
    }
}
