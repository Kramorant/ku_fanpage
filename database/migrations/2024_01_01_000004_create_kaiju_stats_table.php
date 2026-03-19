<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaiju_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->enum('stat_type', ['strength', 'speed', 'health', 'regen']);
            $table->tinyInteger('current_level')->default(0);
            $table->decimal('val_1',  8, 2)->nullable();
            $table->decimal('val_2',  8, 2)->nullable();
            $table->decimal('val_3',  8, 2)->nullable();
            $table->decimal('val_4',  8, 2)->nullable();
            $table->decimal('val_5',  8, 2)->nullable();
            $table->decimal('val_6',  8, 2)->nullable();
            $table->decimal('val_7',  8, 2)->nullable();
            $table->decimal('val_8',  8, 2)->nullable();
            $table->decimal('val_9',  8, 2)->nullable();
            $table->decimal('val_10', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaiju_stats');
    }
};
