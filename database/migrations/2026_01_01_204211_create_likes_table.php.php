<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('likeID');        // Primary key
            $table->unsignedBigInteger('postID');   // Post being liked
            $table->unsignedBigInteger('guestID');  // Guest who liked
            $table->timestamps();                   // created_at and updated_at

            // Prevent duplicate likes
            $table->unique(['postID', 'guestID']);

            // Foreign keys
            $table->foreign('postID')->references('postID')->on('posts')->onDelete('cascade');
            $table->foreign('guestID')->references('guestID')->on('core1_guest')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
