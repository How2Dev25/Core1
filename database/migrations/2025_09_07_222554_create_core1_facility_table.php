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
        Schema::create('core1_facility', function (Blueprint $table) {
            $table->id('facilityID'); // primary key
            $table->string('facility_name'); 
            $table->integer('facility_capacity')->nullable(); 
            $table->enum('facility_type', ['Event', 'Conference'])->default('Event'); 
            $table->json('facility_amenities')->nullable(); 
            $table->enum('facility_status', ['Available', 'Unavailable'])->default('Available'); 
            $table->text('facility_description')->nullable(); 
            $table->string('facility_photo')->nullable(); // <-- added for photo path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_facility');
    }
};
