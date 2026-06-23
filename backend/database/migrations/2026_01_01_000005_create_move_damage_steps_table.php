<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('move_damage_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('move_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('damage_sp_level');
            $table->decimal('damage_min', 8, 2);
            $table->decimal('damage_max', 8, 2);

            $table->unique(['move_id', 'damage_sp_level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('move_damage_steps');
    }
};
