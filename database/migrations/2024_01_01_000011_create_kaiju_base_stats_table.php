<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaiju_base_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->decimal('health_min', 10, 2)->default(0);
            $table->decimal('health_max', 10, 2)->default(0);
            $table->decimal('regen_min',  6, 2)->default(0);
            $table->decimal('regen_max',  6, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaiju_base_stats');
    }
};
