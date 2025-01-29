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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->text('content'); // The comment content
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->unsignedBigInteger('article_id'); // Foreign key to articles
            $table->timestamps(); // Automatically adds created_at and updated_at columns
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
