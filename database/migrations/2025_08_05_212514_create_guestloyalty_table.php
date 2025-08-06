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
        Schema::create('core1_guestloyaltyandrewards', function (Blueprint $table) {
            $table->id('guestloyaltyandrewardsID');
            $table->foreignId('guestID')->nullable();
            $table->foreignId('loyaltyID');
            $table->text('guestemail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_guestloyaltyandrewards');
    }
};
