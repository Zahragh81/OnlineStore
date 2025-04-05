<?php

namespace App\Http\Resources\Shop\Membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'productGroupTypes' => ProductGroupTypeResource::collection($this->whenLoaded('productGroupTypes')),
            'status' => $this->status,
        ];
    }
}
