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
        Schema::create('core1_roomfeedback', function (Blueprint $table) {
            $table->id('roomfeedbackID');
            $table->foreignId('roomID');
            $table->integer('roomrating');
            $table->date('roomfeedbackdate');
            $table->string('roomfeedbackstatus');
            $table->longText('roomfeedbackfeedback');
            $table->foreignId('guestID')->nullable();
            $table->longText('roomfeedbackresponse')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_roomfeedback');
    }
};
