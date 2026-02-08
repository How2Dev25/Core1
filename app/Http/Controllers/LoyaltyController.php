<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\LoyaltyTransaction;
use App\Models\MembershipTier;
use App\Services\LoyaltyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    protected $loyaltyService;

    public function __construct(LoyaltyService $loyaltyService)
    {
        $this->loyaltyService = $loyaltyService;
    }

    /**
     * Display guest loyalty dashboard
     */
    public function dashboard()
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return redirect()->route('guest.login')->with('error', 'Please login to access loyalty program');
        }

        $loyaltySummary = $this->loyaltyService->getLoyaltySummary($guest);
        $availableRewards = $this->loyaltyService->getAvailableRewards();
        $allTiers = MembershipTier::active()->orderBy('min_points')->get();

        return view('guest.loyalty.dashboard', compact(
            'loyaltySummary', 
            'availableRewards', 
            'allTiers'
        ));
    }

    /**
     * Display loyalty transactions
     */
    public function transactions()
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return redirect()->route('guest.login');
        }

        $transactions = $guest->loyaltyTransactions()
            ->orderBy('transaction_date', 'desc')
            ->paginate(20);

        return view('guest.loyalty.transactions', compact('transactions'));
    }

    /**
     * Display available rewards
     */
    public function rewards()
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return redirect()->route('guest.login');
        }

        $loyaltySummary = $this->loyaltyService->getLoyaltySummary($guest);
        $availableRewards = $this->loyaltyService->getAvailableRewards();

        return view('guest.loyalty.rewards', compact(
            'loyaltySummary', 
            'availableRewards'
        ));
    }

    /**
     * Redeem reward points
     */
    public function redeem(Request $request)
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return response()->json(['success' => false, 'message' => 'Please login']);
        }

        $request->validate([
            'reward_id' => 'required|string',
            'points' => 'required|integer|min:1',
        ]);

        $rewards = $this->loyaltyService->getAvailableRewards();
        $reward = collect($rewards)->firstWhere('id', $request->reward_id);

        if (!$reward) {
            return response()->json(['success' => false, 'message' => 'Invalid reward']);
        }

        $result = $this->loyaltyService->redeemPoints(
            $guest, 
            $request->points, 
            $reward['name'],
            "Redeemed {$reward['name']} for {$request->points} points"
        );

        return response()->json($result);
    }

    /**
     * Get membership tiers (API endpoint)
     */
    public function getTiers()
    {
        $tiers = MembershipTier::active()
            ->orderBy('min_points')
            ->get()
            ->map(function ($tier) {
                return [
                    'name' => $tier->tier_name,
                    'min_points' => $tier->min_points,
                    'min_spent' => $tier->min_spent,
                    'food_discount' => $tier->food_discount,
                    'room_discount' => $tier->room_discount,
                    'points_multiplier' => $tier->points_multiplier,
                    'bonus_points' => $tier->bonus_points,
                    'benefits' => $tier->formatted_benefits,
                    'badge_color' => $tier->badge_color,
                ];
            });

        return response()->json($tiers);
    }

    /**
     * Apply food discount (API endpoint)
     */
    public function applyFoodDiscount(Request $request)
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return response()->json(['success' => false, 'message' => 'Please login']);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $discountInfo = $this->loyaltyService->applyFoodDiscount($guest, $request->amount);

        return response()->json([
            'success' => true,
            'discount_info' => $discountInfo,
        ]);
    }

    /**
     * Apply room discount (API endpoint)
     */
    public function applyRoomDiscount(Request $request)
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return response()->json(['success' => false, 'message' => 'Please login']);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $discountInfo = $this->loyaltyService->applyRoomDiscount($guest, $request->amount);

        return response()->json([
            'success' => true,
            'discount_info' => $discountInfo,
        ]);
    }

    /**
     * Process food order and award points (API endpoint)
     */
    public function processFoodOrder(Request $request)
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return response()->json(['success' => false, 'message' => 'Please login']);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'order_id' => 'nullable|integer',
        ]);

        $result = $this->loyaltyService->processFoodOrder($guest, $request->amount);

        return response()->json([
            'success' => true,
            'result' => $result,
        ]);
    }

    /**
     * Process room booking and award points (API endpoint)
     */
    public function processRoomBooking(Request $request)
    {
        $guest = Auth::guard('guest')->user();
        
        if (!$guest) {
            return response()->json(['success' => false, 'message' => 'Please login']);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'booking_id' => 'nullable|integer',
        ]);

        $result = $this->loyaltyService->processRoomBooking($guest, $request->amount);

        return response()->json([
            'success' => true,
            'result' => $result,
        ]);
    }
}
