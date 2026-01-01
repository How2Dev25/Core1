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
        Schema::create('reportpost', function (Blueprint $table) {
            $table->id('reportpostID');
            $table->foreignId('postID');
            $table->longText('reportpost_details')->nullable;
            $table->text('reportpost_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportpost');
    }
};
