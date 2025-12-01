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
        Schema::create('additionalsbooking', function (Blueprint $table) {
            $table->id('additionalsID');
            $table->foreignId('reservationID');
            $table->foreignId('core1_inventoryID');
            $table->decimal('additional_total', 10,2);
            $table->text('additional_status')->default('Unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additionalsbooking');
    }
};
