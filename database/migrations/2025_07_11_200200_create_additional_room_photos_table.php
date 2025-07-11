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
        Schema::create('core1_roomphotos', function (Blueprint $table) {
            $table->id('roomphotoID');
            $table->string('additionalroomphoto');
            $table->foreignId('roomID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_roomphotos');
    }
};
