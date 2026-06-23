<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kaiju;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BuildController extends Controller
{
    public function show(Request $request, Kaiju $kaiju): JsonResponse
    {
        $validated = $request->validate([
            'hp' => ['nullable', 'integer', 'min:0', 'max:10'],
            'speed' => ['nullable', 'integer', 'min:0', 'max:10'],
            'damage' => ['nullable', 'integer', 'min:0', 'max:10'],
            'regen' => ['nullable', 'integer', 'min:0', 'max:10'],
        ]);

        $build = [
            'hp' => (int) ($validated['hp'] ?? 0),
            'speed' => (int) ($validated['speed'] ?? 0),
            'damage' => (int) ($validated['damage'] ?? 0),
            'regen' => (int) ($validated['regen'] ?? 0),
        ];

        if (array_sum($build) > 20) {
            return response()->json(['message' => 'Total skill points cannot exceed 20.'], 422);
        }

        $cacheKey = sprintf('kaijus.%d.build.%d_%d_%d_%d', $kaiju->id, $build['hp'], $build['speed'], $build['damage'], $build['regen']);

        $payload = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($kaiju, $build) {
            $kaiju->loadMissing(['kaijuStatSteps', 'moves.moveDamageSteps']);

            $stats = $kaiju->kaijuStatSteps
                ->whereIn('stat', ['hp', 'speed', 'regen'])
                ->filter(fn ($step) => $step->sp_level === $build[$step->stat])
                ->mapWithKeys(fn ($step) => [
                    $step->stat => [
                        'value_min' => $step->value_min,
                        'value_max' => $step->value_max,
                    ],
                ]);

            $moves = $kaiju->moves->map(fn ($move) => [
                'id' => $move->id,
                'name' => $move->name,
                'description' => $move->description,
                'cooldown' => $move->cooldown,
                'stamina_cost' => $move->stamina_cost,
                'damage' => optional($move->moveDamageSteps->firstWhere('damage_sp_level', $build['damage']), fn ($step) => [
                    'damage_min' => $step->damage_min,
                    'damage_max' => $step->damage_max,
                ]),
            ]);

            return [
                'kaiju_id' => $kaiju->id,
                'build' => $build,
                'stats' => $stats,
                'moves' => $moves,
            ];
        });

        return response()->json($payload);
    }
}
