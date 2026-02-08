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
        Schema::table('core1_guest', function (Blueprint $table) {
            $table->string('membership_tier')->default('Bronze')->after('guest_status');
            $table->integer('loyalty_points')->default(0)->after('membership_tier');
            $table->decimal('total_spent', 10, 2)->default(0)->after('loyalty_points');
            $table->timestamp('membership_since')->nullable()->after('total_spent');
            $table->timestamp('last_activity')->nullable()->after('membership_since');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('core1_guest', function (Blueprint $table) {
            $table->dropColumn([
                'membership_tier',
                'loyalty_points',
                'total_spent',
                'membership_since',
                'last_activity'
            ]);
        });
    }
};
