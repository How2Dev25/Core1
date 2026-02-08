<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoyaltyReward;

class LoyaltyRewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [
            [
                'name' => 'Free Breakfast for Two',
                'description' => 'Enjoy a complimentary breakfast buffet for two people at our hotel restaurant.',
                'category' => 'dining',
                'points_required' => 1000,
                'monetary_value' => 800.00,
                'stock_quantity' => -1,
                'terms_conditions' => [
                    'Valid for 6 months from redemption',
                    'Subject to availability',
                    'Cannot be combined with other promotions',
                    'Advance reservation required'
                ],
            ],
            [
                'name' => 'Room Upgrade',
                'description' => 'Upgrade to the next room category (subject to availability).',
                'category' => 'accommodation',
                'points_required' => 2000,
                'monetary_value' => 1500.00,
                'stock_quantity' => 50,
                'terms_conditions' => [
                    'Valid for one-time use',
                    'Subject to availability at check-in',
                    'Cannot be applied to suites',
                    'Valid for 12 months from redemption'
                ],
            ],
            [
                'name' => 'Spa Voucher',
                'description' => 'Get a ₱500 voucher for any spa treatment or massage.',
                'category' => 'wellness',
                'points_required' => 1500,
                'monetary_value' => 500.00,
                'stock_quantity' => 30,
                'terms_conditions' => [
                    'Valid for 3 months from redemption',
                    'Cannot be exchanged for cash',
                    'One voucher per transaction',
                    'Booking required'
                ],
            ],
            [
                'name' => 'Late Checkout',
                'description' => 'Enjoy late checkout until 2:00 PM (subject to availability).',
                'category' => 'accommodation',
                'points_required' => 500,
                'monetary_value' => 300.00,
                'stock_quantity' => -1,
                'terms_conditions' => [
                    'Must be requested 24 hours in advance',
                    'Subject to availability',
                    'Not available during peak seasons',
                    'Valid for current stay only'
                ],
            ],
            [
                'name' => 'Food & Beverage Credit',
                'description' => 'Get ₱300 credit for food and beverages at any hotel outlet.',
                'category' => 'dining',
                'points_required' => 800,
                'monetary_value' => 300.00,
                'stock_quantity' => 100,
                'terms_conditions' => [
                    'Valid for 2 months from redemption',
                    'Cannot be used for alcoholic beverages',
                    'No cash back for unused amount',
                    'One credit per stay'
                ],
            ],
            [
                'name' => 'Airport Transfer',
                'description' => 'Complimentary one-way airport transfer for up to 4 guests.',
                'category' => 'transportation',
                'points_required' => 2500,
                'monetary_value' => 1200.00,
                'stock_quantity' => 20,
                'terms_conditions' => [
                    'Valid within 30km radius',
                    '48-hour advance booking required',
                    'Subject to vehicle availability',
                    'Valid for 6 months from redemption'
                ],
            ],
            [
                'name' => 'Welcome Amenity',
                'description' => 'Special welcome amenity including fruits, wine, and personalized note.',
                'category' => 'services',
                'points_required' => 600,
                'monetary_value' => 400.00,
                'stock_quantity' => -1,
                'terms_conditions' => [
                    'Available for all room types',
                    'Must be requested at booking',
                    'Valid for new bookings only',
                    'No substitutions allowed'
                ],
            ],
            [
                'name' => 'Poolside Cabana',
                'description' => 'Half-day access to exclusive poolside cabana with complimentary drinks.',
                'category' => 'entertainment',
                'points_required' => 1200,
                'monetary_value' => 800.00,
                'stock_quantity' => 10,
                'terms_conditions' => [
                    'Valid for 4 hours',
                    'Advance reservation required',
                    'Weather-dependent',
                    'Valid for 3 months from redemption'
                ],
            ],
        ];

        foreach ($rewards as $reward) {
            LoyaltyReward::create($reward);
        }
    }
}
