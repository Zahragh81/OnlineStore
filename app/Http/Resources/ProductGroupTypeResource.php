<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductGroupTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'productGroupTypeItems' => ProductGroupTypeItemResource::collection($this->whenLoaded('productGroupTypeItems')),
            'status' => $this->status
        ];
    }
}
