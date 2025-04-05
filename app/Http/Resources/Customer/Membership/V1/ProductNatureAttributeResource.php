<?php

namespace App\Http\Resources\Customer\Membership\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\Membership\V1\ProductNatureAttributeItemResource as CustomerProductNatureAttributeItemResource;

class ProductNatureAttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,

            'productNatureAttributeType' => new ProductNatureAttributeTypeResource($this->whenLoaded('productNatureAttributeType')),
            'productNatureAttributeItems' => CustomerProductNatureAttributeItemResource::collection($this->whenLoaded('productNatureAttributeItems')),

            'status' => $this->status,
        ];
    }
}
