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
        Schema::create('additional_booking', function (Blueprint $table) {
            $table->id('additionalbookingID');
            $table->foreignId('core1_inventoryID');
            $table->foreignId('reservationID');
            $table->decimal('additional_total', 10,2);
            $table->integer('additional_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_booking');
    }
};
