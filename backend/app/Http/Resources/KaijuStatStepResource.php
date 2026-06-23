<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaijuStatStepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stat' => $this->stat,
            'sp_level' => $this->sp_level,
            'value_min' => $this->value_min,
            'value_max' => $this->value_max,
        ];
    }
}
