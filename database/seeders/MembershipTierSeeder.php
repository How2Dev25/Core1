<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipTier;

class MembershipTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = [
            [
                'tier_name' => 'Bronze',
                'min_points' => 0,
                'min_spent' => 0,
                'food_discount' => 20.00,
                'room_discount' => 5.00,
                'points_multiplier' => 1,
                'bonus_points' => 500,
                'benefits' => [
                    '20% discount on food orders',
                    '5% discount on room bookings',
                    '1 point per ₱1 spent',
                    'Welcome bonus: 500 points',
                    'Priority customer support'
                ],
                'badge_color' => '#CD7F32', // Bronze color
                'is_active' => true,
            ],
            [
                'tier_name' => 'Silver',
                'min_points' => 2500,
                'min_spent' => 10000,
                'food_discount' => 25.00,
                'room_discount' => 10.00,
                'points_multiplier' => 1.5,
                'bonus_points' => 1000,
                'benefits' => [
                    '25% discount on food orders',
                    '10% discount on room bookings',
                    '1.5 points per ₱1 spent',
                    'Tier upgrade bonus: 1000 points',
                    'Free room upgrade (subject to availability)',
                    'Early check-in / Late check-out',
                    'Exclusive member events'
                ],
                'badge_color' => '#C0C0C0', // Silver color
                'is_active' => true,
            ],
            [
                'tier_name' => 'Gold',
                'min_points' => 7500,
                'min_spent' => 30000,
                'food_discount' => 30.00,
                'room_discount' => 15.00,
                'points_multiplier' => 2,
                'bonus_points' => 2000,
                'benefits' => [
                    '30% discount on food orders',
                    '15% discount on room bookings',
                    '2 points per ₱1 spent',
                    'Tier upgrade bonus: 2000 points',
                    'Guaranteed room upgrade',
                    'Complimentary breakfast',
                    'Free spa access',
                    'Personal concierge service',
                    'Anniversary gift'
                ],
                'badge_color' => '#FFD700', // Gold color
                'is_active' => true,
            ],
            [
                'tier_name' => 'Platinum',
                'min_points' => 15000,
                'min_spent' => 75000,
                'food_discount' => 35.00,
                'room_discount' => 20.00,
                'points_multiplier' => 3,
                'bonus_points' => 5000,
                'benefits' => [
                    '35% discount on food orders',
                    '20% discount on room bookings',
                    '3 points per ₱1 spent',
                    'Tier upgrade bonus: 5000 points',
                    'Executive suite access',
                    'Complimentary meals',
                    'Airport transfers',
                    'Dedicated 24/7 support',
                    'Exclusive event invitations',
                    'Family membership benefits',
                    'VIP parking'
                ],
                'badge_color' => '#E5E4E2', // Platinum color
                'is_active' => true,
            ],
        ];

        foreach ($tiers as $tier) {
            MembershipTier::create($tier);
        }
    }
}
