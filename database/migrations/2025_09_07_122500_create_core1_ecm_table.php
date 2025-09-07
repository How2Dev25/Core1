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
        Schema::create('core1_ecm', function (Blueprint $table) {
            $table->id('eventbookingID');
            $table->foreignId('eventtype_ID');
            $table->text('eventstatus');
            $table->text('eventorganizer_email');
            $table->text('eventorganizer_name');
            $table->text('eventorganizer_phone');
            $table->text('event_name');
            $table->longText('event_specialrequest');
            $table->text('event_equipment');
            $table->text('event_paymentstatus');
            $table->text('event_paymentmethod');
            $table->date('event_bookedate');
            $table->date('event_checkin');
            $table->date('event_checkout');
            $table->foreignId('guestID')->nullable();
            $table->text('event_eventreceipt')->nullable();
            $table->text('event_bookingreceiptID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_ecm');
    }
};
