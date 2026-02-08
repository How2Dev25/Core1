<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membership_tiers', function (Blueprint $table) {
            $table->id('id');
            $table->string('tier_name'); // Bronze, Silver, Gold, Platinum
            $table->integer('min_points')->default(0);
            $table->decimal('min_spent', 10, 2)->default(0);
            $table->decimal('food_discount', 5, 2)->default(0); // Percentage
            $table->decimal('room_discount', 5, 2)->default(0); // Percentage
            $table->integer('points_multiplier')->default(1); // Points earned per ₱1 spent
            $table->integer('bonus_points')->default(0); // Bonus points upon availing
            $table->json('benefits')->nullable(); // Additional benefits
            $table->string('badge_color')->default('#CD7F32'); // Bronze color
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_tiers');
    }
};
