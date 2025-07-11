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
        Schema::create('core1_room', function (Blueprint $table) {
            $table->id('roomID');
            $table->string('roomtype');
            $table->integer('roomsize');
            $table->integer('roommaxguest');
            $table->longText('roomfeatures');
            $table->longText('roomdescription');
            $table->string('roomphoto');
            $table->integer('roomprice');
            $table->string('roomstatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_room');
    }
};
