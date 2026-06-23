<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KaijuResource;
use App\Models\Kaiju;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FavouriteController extends Controller
{
    public function toggle(Kaiju $kaiju): JsonResponse
    {
        $user = request()->user();

        if ($user->favouriteKaijus()->whereKey($kaiju->id)->exists()) {
            $user->favouriteKaijus()->detach($kaiju->id);

            return response()->json(['favourited' => false]);
        }

        $user->favouriteKaijus()->attach($kaiju->id);

        return response()->json(['favourited' => true]);
    }

    public function index(): AnonymousResourceCollection
    {
        $favourites = request()->user()
            ->favouriteKaijus()
            ->with(['kaijuStatSteps', 'moves.moveDamageSteps'])
            ->get();

        return KaijuResource::collection($favourites);
    }
}
