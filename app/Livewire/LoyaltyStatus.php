<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Guest;
use App\Models\MembershipTier;
use Illuminate\Support\Facades\Auth;

class LoyaltyStatus extends Component
{
    public $currentTier;
    public $loyaltyPoints;
    public $totalSpent;
    public $benefits;
    public $nextTier;
    public $progressPercentage;
    public $badgeColor;

    public function mount()
    {
        $this->updateLoyaltyStatus();
    }

    public function updateLoyaltyStatus()
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return;
        }

        // Initialize membership if not set
        if (!$guest->membership_tier) {
            $guest->membership_tier = 'Bronze';
            $guest->membership_since = now();
            $guest->save();
        }

        $this->currentTier = $guest->membership_tier;
        $this->loyaltyPoints = (int) $guest->loyalty_points; // Ensure it's an integer
        $this->totalSpent = (float) $guest->total_spent; // Ensure it's a float
        
        $membershipTier = MembershipTier::where('tier_name', $this->currentTier)->first();
        $this->benefits = $membershipTier ? $membershipTier->formatted_benefits : [];
        $this->badgeColor = $membershipTier ? $membershipTier->badge_color : '#CD7F32';

        // Calculate next tier progress
        $nextTier = MembershipTier::active()
            ->where('min_points', '>', $membershipTier->min_points ?? 0)
            ->orderBy('min_points')
            ->first();

        if ($nextTier) {
            $this->nextTier = $nextTier->tier_name;
            $pointsNeeded = $nextTier->min_points - $this->loyaltyPoints;
            $this->progressPercentage = min(100, ($this->loyaltyPoints / $nextTier->min_points) * 100);
        } else {
            $this->nextTier = null;
            $this->progressPercentage = 100;
        }
    }

    public function render()
    {
        return view('livewire.loyalty-status');
    }
}
