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
        Schema::create('core1_stockrequest', function (Blueprint $table) {
            $table->id('core1_stockID');
            $table->string('core1_requestID')->nullable()->unique();
            $table->longText('core1_request_items');
            $table->string('core1_request_status');
            $table->string('core1_request_category');
            $table->string('core1_request_priority');
            $table->integer('core1_request_needed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1stockrequest');
    }
};
