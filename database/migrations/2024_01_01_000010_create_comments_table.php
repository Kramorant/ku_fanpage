<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('post_type', ['kaiju', 'event', 'blog']);
            $table->unsignedBigInteger('post_id');
            $table->text('content');
            $table->timestamps();

            $table->index(['post_type', 'post_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
