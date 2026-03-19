<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaiju_regens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->decimal('health_regen_pct', 5, 2)->default(0);
            $table->decimal('charge_regen_pct', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaiju_regens');
    }
};
