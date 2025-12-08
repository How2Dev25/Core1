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
        Schema::create('doorlock', function (Blueprint $table) {
            $table->id('doorlockID');
            $table->text('rfid')->unique();
            $table->text('doorlock_status')->default('Innactive');
            $table->foreignId('roomID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doorlock');
    }
};
