<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kaijus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->boolean('can_fly')->default(false);
            $table->boolean('can_glide')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaijus');
    }
};
