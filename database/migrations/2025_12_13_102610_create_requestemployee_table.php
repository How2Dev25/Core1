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
        Schema::create('requestemployee', function (Blueprint $table) {
            $table->id('requestempID');
            $table->string('request_id')->unique(); // RE-001, RE-002 etc
            $table->string('department');
            $table->string('requested_by'); // can be Auth::user()->employee_name / role
            $table->string('position');
            $table->integer('quantity');
            $table->string('employment_type');
            $table->string('shift');
            $table->string('reason');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requestemployee');
    }
};
