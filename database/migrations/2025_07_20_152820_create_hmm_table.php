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
        Schema::create('core1_roommaintenance', function (Blueprint $table) {
            $table->id('roommaintenanceID');
            $table->foreignId('roomID');
            $table->longText('maintenancedescription')->nullable();
            $table->text('maintenancestatus')->nullable();
            $table->text('maintenanceassigned_To'); 
            $table->text('maintenance_priority')->nullable();
            $table->timestamps();
        });
    }
    // change the assigned to text to foreignID after finishing userManagement

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hmm');
    }
};
