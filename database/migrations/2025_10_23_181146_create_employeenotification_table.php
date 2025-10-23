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
        Schema::create('employeenotification', function (Blueprint $table) {
            $table->id('notificationempID');
            $table->text('module');
            $table->longText('message');
            $table->foreignId('guestID')->nullable();
            $table->text('guestname');
            $table->text('status')->default('unread');
            $table->text('topic');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeenotification');
    }
};
