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
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title');
            $table->text('content');
            $table->date('published_at')->nullable();
            $table->enum('status', ['Rejected', 'Pending', 'Approved', 'Published']);
            $table->unsignedBigInteger('theme_id'); // Foreign key to themes
            $table->unsignedBigInteger('proposed_by'); // Foreign key to users
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->foreign('proposed_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
