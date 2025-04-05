<?php

namespace App\Http\Resources\Admin\Membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'vehicle_name' => $this->vehicle_name,
            'user' => new UserResource($this->whenLoaded('user')),
            'courierType' => new CourierTypeResource($this->whenLoaded('courierType')),
            'status' => $this->status
        ];
    }
}
