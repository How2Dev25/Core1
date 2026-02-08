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
        Schema::create('loyalty_rewards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('category'); // dining, accommodation, wellness, entertainment, etc.
            $table->integer('points_required');
            $table->decimal('monetary_value', 10, 2)->nullable(); // Actual value of reward
            $table->string('image_url')->nullable();
            $table->json('terms_conditions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('stock_quantity')->default(-1); // -1 for unlimited
            $table->timestamp('expires_at')->nullable();
            $table->integer('redemption_count')->default(0);
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_rewards');
    }
};
