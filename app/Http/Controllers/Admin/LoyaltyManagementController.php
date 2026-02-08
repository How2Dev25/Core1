<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyReward;
use App\Models\MembershipTier;
use App\Models\LoyaltyTransaction;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyManagementController extends Controller
{
    public function __construct()
    {
        // Remove middleware, will use Auth::user() directly
    }

    /**
     * Display loyalty management dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_rewards' => LoyaltyReward::count(),
            'active_rewards' => LoyaltyReward::active()->count(),
            'total_redemptions' => LoyaltyReward::sum('redemption_count'),
            'total_members' => Guest::whereNotNull('membership_tier')->count(),
        ];

        $recentRedemptions = LoyaltyTransaction::with('guest')
            ->where('transaction_type', 'redeemed')
            ->orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();

        $topRewards = LoyaltyReward::orderBy('redemption_count', 'desc')
            ->take(5)
            ->get();

        $tierDistribution = Guest::select('membership_tier', \DB::raw('count(*) as count'))
            ->whereNotNull('membership_tier')
            ->groupBy('membership_tier')
            ->get();

        return view('admin.loyalty.dashboard', compact(
            'stats', 
            'recentRedemptions', 
            'topRewards', 
            'tierDistribution'
        ));
    }

    /**
     * Display rewards management
     */
    public function rewards(Request $request)
    {
        $query = LoyaltyReward::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'expired') {
                $query->where('expires_at', '<', now());
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $rewards = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = LoyaltyReward::select('category')->distinct()->pluck('category');

        return view('admin.loyalty.rewards', compact('rewards', 'categories'));
    }

    /**
     * Show create reward form
     */
    public function createReward()
    {
        $categories = [
            'dining' => 'Dining & Food',
            'accommodation' => 'Accommodation',
            'wellness' => 'Wellness & Spa',
            'entertainment' => 'Entertainment',
            'transportation' => 'Transportation',
            'shopping' => 'Shopping',
            'services' => 'Services',
        ];

        return view('admin.loyalty.create-reward', compact('categories'));
    }

    /**
     * Store new reward
     */
    public function storeReward(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:dining,accommodation,wellness,entertainment,transportation,shopping,services',
            'points_required' => 'required|integer|min:1',
            'monetary_value' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock_quantity' => 'nullable|integer|min:-1',
            'expires_at' => 'nullable|date|after:now',
            'terms_conditions' => 'nullable|array',
            'admin_notes' => 'nullable|string',
        ]);

        $reward = LoyaltyReward::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'points_required' => $request->points_required,
            'monetary_value' => $request->monetary_value,
            'image_url' => $request->image_url,
            'stock_quantity' => $request->stock_quantity ?? -1,
            'expires_at' => $request->expires_at,
            'terms_conditions' => $request->terms_conditions,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.loyalty.rewards')
            ->with('success', 'Reward "' . $reward->name . '" has been created successfully!');
    }

    /**
     * Show edit reward form
     */
    public function editReward(LoyaltyReward $reward)
    {
        $categories = [
            'dining' => 'Dining & Food',
            'accommodation' => 'Accommodation',
            'wellness' => 'Wellness & Spa',
            'entertainment' => 'Entertainment',
            'transportation' => 'Transportation',
            'shopping' => 'Shopping',
            'services' => 'Services',
        ];

        return view('admin.loyalty.edit-reward', compact('reward', 'categories'));
    }

    /**
     * Update reward
     */
    public function updateReward(Request $request, LoyaltyReward $reward)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:dining,accommodation,wellness,entertainment,transportation,shopping,services',
            'points_required' => 'required|integer|min:1',
            'monetary_value' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock_quantity' => 'nullable|integer|min:-1',
            'expires_at' => 'nullable|date|after:now',
            'terms_conditions' => 'nullable|array',
            'admin_notes' => 'nullable|string',
        ]);

        $reward->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'points_required' => $request->points_required,
            'monetary_value' => $request->monetary_value,
            'image_url' => $request->image_url,
            'stock_quantity' => $request->stock_quantity ?? -1,
            'expires_at' => $request->expires_at,
            'terms_conditions' => $request->terms_conditions,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.loyalty.rewards')
            ->with('success', 'Reward "' . $reward->name . '" has been updated successfully!');
    }

    /**
     * Toggle reward status
     */
    public function toggleRewardStatus(LoyaltyReward $reward)
    {
        $reward->is_active = !$reward->is_active;
        $reward->save();

        $status = $reward->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.loyalty.rewards')
            ->with('success', 'Reward "' . $reward->name . '" has been ' . $status . '!');
    }

    /**
     * Delete reward
     */
    public function deleteReward(LoyaltyReward $reward)
    {
        $rewardName = $reward->name;
        $reward->delete();

        return redirect()->route('admin.loyalty.rewards')
            ->with('success', 'Reward "' . $rewardName . '" has been deleted successfully!');
    }

    /**
     * Display membership tiers management
     */
    public function tiers()
    {
        $tiers = MembershipTier::active()->orderBy('min_points')->get();
        return view('admin.loyalty.tiers', compact('tiers'));
    }

    /**
     * Show edit tier form
     */
    public function editTier(MembershipTier $tier)
    {
        return view('admin.loyalty.edit-tier', compact('tier'));
    }

    /**
     * Update membership tier
     */
    public function updateTier(Request $request, MembershipTier $tier)
    {
        $request->validate([
            'food_discount' => 'required|numeric|min:0|max:100',
            'room_discount' => 'required|numeric|min:0|max:100',
            'points_multiplier' => 'required|numeric|min:0.1|max:10',
            'bonus_points' => 'required|integer|min:0',
            'benefits' => 'nullable|array',
        ]);

        $tier->update([
            'food_discount' => $request->food_discount,
            'room_discount' => $request->room_discount,
            'points_multiplier' => $request->points_multiplier,
            'bonus_points' => $request->bonus_points,
            'benefits' => $request->benefits,
        ]);

        return redirect()->route('admin.loyalty.tiers')
            ->with('success', 'Tier "' . $tier->tier_name . '" has been updated successfully!');
    }

    /**
     * Display transactions
     */
    public function transactions(Request $request)
    {
        $query = LoyaltyTransaction::with('guest');

        // Filter by type
        if ($request->filled('type')) {
            $query->where('transaction_type', $request->type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }

        // Search
        if ($request->filled('search')) {
            $query->whereHas('guest', function($q) use ($request) {
                $q->where('guest_name', 'like', '%' . $request->search . '%')
                  ->orWhere('guest_email', 'like', '%' . $request->search . '%');
            });
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(20);

        return view('admin.loyalty.transactions', compact('transactions'));
    }

    /**
     * Display members list
     */
    public function members(Request $request)
    {
        $query = Guest::whereNotNull('membership_tier');

        // Filter by tier
        if ($request->filled('tier')) {
            $query->where('membership_tier', $request->tier);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('guest_name', 'like', '%' . $request->search . '%')
                  ->orWhere('guest_email', 'like', '%' . $request->search . '%');
            });
        }

        $members = $query->orderBy('created_at', 'desc')->paginate(20);
        $tiers = MembershipTier::active()->pluck('tier_name');

        return view('admin.loyalty.members', compact('members', 'tiers'));
    }

    /**
     * Add points to a member
     */
   
}
