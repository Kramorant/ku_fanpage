<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kaiju_stat_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->enum('stat', ['hp', 'speed', 'regen']);
            $table->unsignedTinyInteger('sp_level');
            $table->decimal('value_min', 8, 2);
            $table->decimal('value_max', 8, 2);

            $table->unique(['kaiju_id', 'stat', 'sp_level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaiju_stat_steps');
    }
};
