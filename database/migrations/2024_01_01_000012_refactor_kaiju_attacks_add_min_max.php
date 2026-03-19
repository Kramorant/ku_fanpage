<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kaiju_attacks', function (Blueprint $table) {
            $table->decimal('damage_min', 8, 2)->default(0)->after('name');
            $table->decimal('damage_max', 8, 2)->default(0)->after('damage_min');
            $table->dropColumn('damage');
        });
    }

    public function down(): void
    {
        Schema::table('kaiju_attacks', function (Blueprint $table) {
            $table->decimal('damage', 8, 2)->default(0)->after('name');
            $table->dropColumn(['damage_min', 'damage_max']);
        });
    }
};
