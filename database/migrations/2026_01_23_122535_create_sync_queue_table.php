<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sync_queue', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('model_name', 50); // e.g., 'Employee'
            $table->unsignedBigInteger('record_id'); // primary key of the record in main table
            $table->enum('action', ['insert', 'update', 'delete']);
            $table->json('payload'); // store record data
            $table->boolean('synced')->default(false); // 0 = not synced, 1 = synced
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sync_queue');
    }
};
