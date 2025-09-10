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
        Schema::create('resto_cart', function (Blueprint $table) {
            $table->id('cartID');
            $table->foreignId('menuID');
            $table->text('bookingID');
            $table->integer('order_quantity');
            $table->text('order_status')->default('Pending');
            $table->foreignId('guestID')->nullable();
            $table->text('orderguest_name');
            $table->text('orderguest_email');
            $table->text('orderguest_contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resto_cart');
    }
};
