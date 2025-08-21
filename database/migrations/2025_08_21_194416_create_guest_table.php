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
        Schema::create('core1_guest', function (Blueprint $table) {
            $table->id('guestID');
            $table->text('guest_email');
            $table->text('guest_name');
            $table->text('guest_photo')->nullable();
            $table->text('guest_address');
            $table->text('guest_mobile');
            $table->text('guest_password');
            $table->date('guest_birthday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest');
    }
};
