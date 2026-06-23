<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaijuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_path' => $this->image_path,
            'thumbnail_path' => $this->thumbnail_path,
            'can_fly' => $this->can_fly,
            'can_glide' => $this->can_glide,
            'stat_steps' => KaijuStatStepResource::collection($this->whenLoaded('kaijuStatSteps')),
            'moves' => MoveResource::collection($this->whenLoaded('moves')),
        ];
    }
}
