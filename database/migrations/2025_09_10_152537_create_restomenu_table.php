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
        Schema::create('resto_integration', function (Blueprint $table) {
            $table->id('menuID');
            $table->text('menu_name');
            $table->text('menu_description');
            $table->text('menu_photo');
            $table->integer('menu_price');
            $table->text('menu_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resto_integration');
    }
};
