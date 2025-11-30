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
        Schema::create('inventorypos', function (Blueprint $table) {
            $table->id('inventoryposID');
            $table->foreignId('reservationposID');
            $table->foreignId('core1_inventoryID');
            $table->decimal('inventorypos_total',10,2);
            $table->integer('inventorypos_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventorypos');
    }
};
