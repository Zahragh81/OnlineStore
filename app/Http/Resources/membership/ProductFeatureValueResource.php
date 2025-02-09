<?php

namespace App\Http\Resources\membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFeatureValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'value' => $this->value,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'productNatureAttribute' => new ProductFeatureValueResource($this->whenLoaded('productNatureAttribute')),
            'status' => $this->status,
        ];

    }
}
