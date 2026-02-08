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
        Schema::create('loyalty_transactions', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('guestID');
            $table->string('transaction_type'); // earned, redeemed, bonus, expired
            $table->integer('points_change');
            $table->decimal('amount', 10, 2)->nullable(); // Amount spent or redeemed
            $table->string('reference_type')->nullable(); // reservation, food_order, room_booking
            $table->foreignId('reference_id')->nullable();
            $table->text('description');
            $table->timestamp('transaction_date');
            $table->integer('points_balance_after');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_transactions');
    }
};
