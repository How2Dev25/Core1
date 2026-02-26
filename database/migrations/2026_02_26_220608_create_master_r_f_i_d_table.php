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
        Schema::create('masterRFID', function (Blueprint $table) {
         $table->id('masterRFID_ID');
            $table->text('masterRFID_rfid');
            $table->text('masterRFID_name');
            $table->text('masterRFID_status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterRFID');
    }
};
