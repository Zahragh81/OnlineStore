<?php

namespace App\Http\Resources\Customer\Membership\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\Membership\V1\ProductNatureAttributeResource as CustomerProductNatureAttributeResource;

class ProductNatureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => new FileResource($this->whenLoaded('logo')),
            'productNatureAttributes' => CustomerProductNatureAttributeResource::collection($this->whenLoaded('productNatureAttributes')),
            'storeType' => new StoreTypeResource($this->whenLoaded('storeType')),
            'status' => $this->status,
        ];
    }
}
