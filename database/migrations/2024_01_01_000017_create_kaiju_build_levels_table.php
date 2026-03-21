<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaiju_build_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('level'); // 0 to 10
            $table->decimal('damage_multiplier', 6, 4)->default(1.0000);
            $table->decimal('walking',   6, 2)->nullable();
            $table->decimal('sprinting', 6, 2)->nullable();
            $table->decimal('swimming',  6, 2)->nullable();
            $table->decimal('flying',    6, 2)->nullable();
            $table->decimal('health', 10, 2)->nullable();
            $table->decimal('health_regen', 6, 3)->nullable();
            $table->decimal('charge_regen', 6, 3)->nullable();
            $table->timestamps();
            $table->unique(['kaiju_id', 'level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaiju_build_levels');
    }
};
