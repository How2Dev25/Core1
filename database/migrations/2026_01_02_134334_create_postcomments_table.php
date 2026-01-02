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
        Schema::create('postcomments', function (Blueprint $table) {
            $table->id('postcommentID');
            $table->foreignId('postID');
            $table->foreignId('commenterID')->nullable();
            $table->text('commenter_role')->default('Guest');
            $table->text('comment_image')->nullable();
            $table->text('comment_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postcomments');
    }
};
