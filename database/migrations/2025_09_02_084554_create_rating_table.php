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
        Schema::create('core1_rating', function (Blueprint $table) {
            $table->id('ratingID');
            $table->text('rating_name');
            $table->text('rating_email');
            $table->text('rating_location');
            $table->longText('rating_description');
            $table->integer('rating_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_rating');
    }
};
