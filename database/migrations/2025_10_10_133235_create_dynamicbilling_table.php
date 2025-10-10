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
        Schema::create('dynamic_billing', function (Blueprint $table) {
            $table->id('dynamic_billingID');
            $table->string('dynamic_name');
            $table->decimal('dynamic_price', 8, 2);
            $table->longText('dynamic_billing_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_billing');
    }
};
