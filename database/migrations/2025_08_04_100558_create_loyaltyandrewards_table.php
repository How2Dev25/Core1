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
        Schema::create('core1_loyaltyandrewards', function (Blueprint $table) {
            $table->id('loyaltyID');
            $table->foreignId('roomID');
            $table->foreignId('guestID')->nullable();
            $table->text('guestemail')->nullable();
            $table->longText('loyalty_description');
            $table->integer('loyalty_value');
            $table->text('loyalty_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_loyaltyandrewards');
    }
};
