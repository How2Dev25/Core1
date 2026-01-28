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
        Schema::table('orderfromresto', function (Blueprint $table) {
            $table->text('payment_resto_status')->default('Pending')->after('order_status');
            $table->text('payment_method')->nullable()->after('payment_resto_status');
            $table->timestamp('payment_date')->nullable()->after('payment_method');
            $table->text('transaction_ref')->nullable()->after('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orderfromresto', function (Blueprint $table) {
            $table->dropColumn([
                'payment_resto_status',
                'payment_method', 
                'payment_date',
                'transaction_ref'
            ]);
        });
    }
};
