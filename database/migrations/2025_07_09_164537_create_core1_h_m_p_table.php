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
        Schema::create('core1_HMP', function (Blueprint $table) {
            $table->id('promoID');
            $table->text('hotelpromophoto');
            $table->text('hotelpromoname');
            $table->text('hotelpromotag');
            $table->text('hotelpromodaterange');
            $table->text('hotelpromostatus');
            $table->longText('hotelpromodescription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_HMP');
    }
};
