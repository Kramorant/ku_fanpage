<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kaiju_attacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaiju_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('damage', 8, 2)->default(0);
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kaiju_attacks');
    }
};
