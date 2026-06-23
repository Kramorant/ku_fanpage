<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KaijuResource;
use App\Models\Kaiju;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class KaijuController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $kaijus = Cache::remember('kaijus.index', now()->addMinutes(60), fn () => Kaiju::query()
            ->with(['kaijuStatSteps', 'moves.moveDamageSteps'])
            ->orderBy('name')
            ->get());

        return KaijuResource::collection($kaijus);
    }

    public function show(Kaiju $kaiju): KaijuResource
    {
        $cached = Cache::remember("kaijus.show.{$kaiju->id}", now()->addMinutes(60), fn () => Kaiju::query()
            ->with(['kaijuStatSteps', 'moves.moveDamageSteps'])
            ->findOrFail($kaiju->id));

        return new KaijuResource($cached);
    }
}
