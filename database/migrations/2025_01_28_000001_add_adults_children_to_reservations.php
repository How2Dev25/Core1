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
        Schema::table('core1_reservation', function (Blueprint $table) {
            $table->integer('reservation_adults')->default(1)->after('reservation_numguest');
            $table->integer('reservation_children')->default(0)->after('reservation_adults');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('core1_reservation', function (Blueprint $table) {
            $table->dropColumn(['reservation_adults', 'reservation_children']);
        });
    }
};
