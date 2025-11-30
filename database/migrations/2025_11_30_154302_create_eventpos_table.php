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
        Schema::create('eventpos', function (Blueprint $table) {
          $table->id('eventposID'); // primary key
                // Foreign Keys / IDs
                $table->unsignedBigInteger('eventtype_ID');

                // Organizer Information
                $table->string('eventorganizer_email');
                $table->string('eventorganizer_name');
                $table->string('eventorganizer_phone');

                // Event Details
                $table->string('event_name');
                $table->text('event_specialrequest')->nullable();
                $table->text('event_equipment')->nullable();

                // Payment Method
                $table->string('event_paymentmethod'); // online or onsite

                // Schedule
                $table->date('event_checkin');
                $table->date('event_checkout');

                // Guests & Price
                $table->integer('event_numguest');
                $table->decimal('event_total_price', 10, 2);

                // Employee who processed the POS
                $table->foreignId('employeeID');

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventpos');
    }
};
