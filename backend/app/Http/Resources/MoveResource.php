<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MoveResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cooldown' => $this->cooldown,
            'stamina_cost' => $this->stamina_cost,
            'damage_steps' => MoveDamageStepResource::collection($this->whenLoaded('moveDamageSteps')),
        ];
    }
}
