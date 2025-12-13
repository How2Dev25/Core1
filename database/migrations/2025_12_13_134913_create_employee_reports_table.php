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
        Schema::create('employee_reports', function (Blueprint $table) {
               $table->id('reportID');

            // REP-001 format
            $table->string('report_code')->unique();

            // Employee reference
            $table->string('employee_id');
            $table->string('employee_name');
            $table->string('position');
            $table->string('department');

            // Report details
            $table->date('last_date');
            $table->integer('days_absent')->default(0);
            $table->string('actions_taken')->nullable();

            // Status tracking
            $table->enum('status', ['Pending', 'Resolved', 'Escalated'])
                  ->default('Pending');

            // Metadata
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_reports');
    }
};
