<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MoveDamageStepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'damage_sp_level' => $this->damage_sp_level,
            'damage_min' => $this->damage_min,
            'damage_max' => $this->damage_max,
        ];
    }
}
