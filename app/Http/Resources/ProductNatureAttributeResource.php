<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductNatureAttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,

            'productNatureAttributeType' => new ProductNatureAttributeTypeResource($this->whenLoaded('productNatureAttributeType')),
            'productNatureAttributeItems' => ProductNatureAttributeItemResource::collection($this->whenLoaded('productNatureAttributeItems')),

            'status' => $this->status,
        ];
    }
}
