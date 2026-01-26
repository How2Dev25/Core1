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
        Schema::table('department_accounts', function (Blueprint $table) {
            $table->boolean('is_locked')->default(false)->after('status');
            $table->timestamp('locked_until')->nullable()->after('is_locked');
            $table->integer('otp_failed_attempts')->default(0)->after('locked_until');
            $table->timestamp('last_otp_attempt')->nullable()->after('otp_failed_attempts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('department_accounts', function (Blueprint $table) {
            $table->dropColumn(['is_locked', 'locked_until', 'otp_failed_attempts', 'last_otp_attempt']);
        });
    }
};
