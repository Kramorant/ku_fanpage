<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('kaiju_stats');
        Schema::dropIfExists('kaiju_regens');
    }

    public function down(): void
    {
        Schema::create('kaiju_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->string('stat_type');
            $table->unsignedTinyInteger('current_level')->default(0);
            for ($i = 1; $i <= 10; $i++) {
                $table->decimal("val_{$i}", 10, 2)->nullable();
            }
            $table->timestamps();
        });

        Schema::create('kaiju_regens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->decimal('health_regen_pct', 6, 2)->default(0);
            $table->decimal('charge_regen_pct', 6, 2)->default(0);
            $table->timestamps();
        });
    }
};
