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
          Schema::create('aiprompts', function (Blueprint $table) {
            $table->id('aipromptsID');
            $table->unsignedBigInteger('guestID')->nullable(); // optional, in case guest is not logged in
            $table->text('prompt_text'); // original guest prompt
            $table->string('roomtype')->nullable();
            $table->integer('roommaxguest')->nullable();
            $table->json('roomfeatures')->nullable(); // store as JSON
            $table->integer('reservation_days')->nullable();
            $table->date('checkin_date')->nullable();
            $table->date('checkout_date')->nullable();
            $table->text('special_request')->nullable();
            $table->longText('raw_json')->nullable(); // raw AI or mock response
            $table->timestamps();

            
        });
    }
    
    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aiprompts');
    }
};
