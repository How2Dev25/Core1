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
        Schema::create('doorlockfrontdesk', function (Blueprint $table) {
            $table->id('doorlockfrontdeskID');
            $table->foreignId('guestID')->nullable();
            $table->foreignId('doorlockID');
            $table->text('bookingID');
            $table->text('guestName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doorlockfrontdesk');
    }
};
