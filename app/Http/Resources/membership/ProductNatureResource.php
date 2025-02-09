<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductNatureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => new FileResource($this->whenLoaded('logo')),
            'productNatureAttributes' => ProductNatureAttributeResource::collection($this->whenLoaded('productNatureAttributes')),
            'storeType' => new StoreTypeResource($this->whenLoaded('storeType')),
            'status' => $this->status,
        ];
    }
}
