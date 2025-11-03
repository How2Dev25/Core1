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
        Schema::create('loyaltyrules', function (Blueprint $table) {
            $table->id('loyaltyrulesID');
            $table->integer('points_required');
            $table->decimal('discount_percent');
            $table->text('loyalty_rule_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyaltyrules');
    }
};
