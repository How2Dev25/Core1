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
            $table->string('early_checkin_time')->nullable()->after('reservation_specialrequest');
            $table->string('late_checkout_time')->nullable()->after('early_checkin_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('core1_reservation', function (Blueprint $table) {
            $table->dropColumn(['early_checkin_time', 'late_checkout_time']);
        });
    }
};
