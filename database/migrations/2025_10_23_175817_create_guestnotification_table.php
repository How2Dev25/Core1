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
        Schema::create('guestnotification', function (Blueprint $table) {
            $table->id('notificationguestID');
            $table->foreignId('guestID');
            $table->text('module');
            $table->text('guestname');
            $table->text('topic');
            $table->longText('message');
              $table->text('status')->default('unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guestnotification');
    }
};
