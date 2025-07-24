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
        Schema::create('core1_reservation', function (Blueprint $table) {
            $table->id('reservationID');
            $table->foreignId('roomID');
            $table->date('reservation_checkin');
            $table->date('reservation_checkout');
            $table->string('bookedvia');
            $table->longText('reservation_specialrequest');
            $table->integer('reservation_numguest');
            $table->string('guestname');
            $table->string('guestphonenumber');
            $table->string('guestemailaddress');
            $table->date('guestbirthday');
            $table->longText('guestaddress');
            $table->string('guestcontactperson');
            $table->string('guestcontactpersonnumber');
            $table->string('reservation_bookingstatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_reservation');
    }
};
