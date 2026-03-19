<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kaiju_speeds', function (Blueprint $table) {
            $table->decimal('walking_min',   6, 2)->default(0)->after('kaiju_id');
            $table->decimal('walking_max',   6, 2)->default(0)->after('walking_min');
            $table->decimal('sprinting_min', 6, 2)->default(0)->after('walking_max');
            $table->decimal('sprinting_max', 6, 2)->default(0)->after('sprinting_min');
            $table->decimal('swimming_min',  6, 2)->default(0)->after('sprinting_max');
            $table->decimal('swimming_max',  6, 2)->default(0)->after('swimming_min');
            $table->decimal('flying_min',    6, 2)->nullable()->after('swimming_max');
            $table->decimal('flying_max',    6, 2)->nullable()->after('flying_min');
            $table->dropColumn(['walking_speed', 'sprinting_speed', 'swimming_speed']);
        });
    }

    public function down(): void
    {
        Schema::table('kaiju_speeds', function (Blueprint $table) {
            $table->decimal('walking_speed',   6, 2)->default(0);
            $table->decimal('sprinting_speed', 6, 2)->default(0);
            $table->decimal('swimming_speed',  6, 2)->default(0);
            $table->dropColumn([
                'walking_min', 'walking_max',
                'sprinting_min', 'sprinting_max',
                'swimming_min', 'swimming_max',
                'flying_min', 'flying_max',
            ]);
        });
    }
};
