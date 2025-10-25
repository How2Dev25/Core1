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
        Schema::create('additionalinfoadmin', function (Blueprint $table) {
            $table->id('additionalinfoadminID');
            $table->foreignId('Dept_no')->nullable();
            $table->text('adminphoto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additionalinfoadmin');
    }
};
