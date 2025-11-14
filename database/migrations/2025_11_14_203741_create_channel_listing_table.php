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
        Schema::create('channel_listing', function (Blueprint $table) {
            $table->id('channelListingID');
            $table->text('channelName');
            $table->text('channelPhoto');
            $table->text('channelDescription');
            $table->text('channelStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_listing');
    }
};
