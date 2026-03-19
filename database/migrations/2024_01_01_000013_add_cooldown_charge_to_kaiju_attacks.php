<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kaiju_attacks', function (Blueprint $table) {
            $table->decimal('cooldown', 6, 2)->nullable()->after('damage_max');
            $table->decimal('charge_cost', 8, 2)->nullable()->after('cooldown');
        });
    }

    public function down(): void
    {
        Schema::table('kaiju_attacks', function (Blueprint $table) {
            $table->dropColumn(['cooldown', 'charge_cost']);
        });
    }
};
