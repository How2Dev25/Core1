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
        Schema::create('core1_eventtype', function (Blueprint $table) {
            $table->id('eventtype_ID');
            $table->string('eventtype_name');
            $table->string('eventtype_photo')->nullable();
            $table->decimal('eventtype_price', 10, 2)->default(0);
            $table->text('eventtype_description')->nullable();
            $table->integer('eventtype_capacity')->nullable();
            $table->foreignId('facilityID')->nullable();
            $table->json('eventtype_amenities')->nullable();
            $table->string('eventtype_duration')->nullable();
            $table->json('eventtype_catering_options')->nullable();
            $table->json('eventtype_theme_options')->nullable();
            $table->text('eventtype_booking_policy')->nullable();
            $table->json('eventtype_extra_services')->nullable();
            $table->enum('eventtype_status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::dropIfExists('core1_eventtype');
    }
};
