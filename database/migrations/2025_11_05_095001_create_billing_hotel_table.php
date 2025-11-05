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
        Schema::create('billing_hotel', function (Blueprint $table) {
            $table->id('billingID');
            $table->text('transactionID')->nullable();
            $table->text('transaction_reference');
            $table->foreignId('guestID')->nullable();
            $table->text('guestname');
            $table->dateTime('payment_date');
            $table->decimal('amount_paid', 10, 2);
            $table->text('payment_status')->default('Paid');
            $table->text('remarks')->nullable();
            $table->text('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_hotel');
    }
};
