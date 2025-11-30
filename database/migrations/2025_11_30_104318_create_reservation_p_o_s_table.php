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
        Schema::create('reservationPOS', function (Blueprint $table) {
            $table->id('reservationposID'); // primary key
            $table->unsignedBigInteger('roomID');
            $table->date('reservation_checkin');
            $table->date('reservation_checkout');
            $table->string('reservation_specialrequest');
            $table->integer('reservation_numguest');
            $table->string('guestname');
            $table->string('guestphonenumber');
            $table->string('guestemailaddress');
            $table->date('guestbirthday');
            $table->string('guestaddress');
            $table->string('guestcontactperson');
            $table->string('guestcontactpersonnumber');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->decimal('serviceFee', 10, 2);
            $table->decimal('total', 10, 2);
            $table->foreignId('employeeID');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservationPOS');
    }
};
