<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductBalanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'number' => $this->number,

            'product' => new ProductResource($this->whenLoaded('product')),
            'store' => new StoreResource($this->whenLoaded('store')),
            'productBalanceAttributes' => ProductBalanceAttributeResource::collection($this->whenLoaded('productBalanceAttributes')),
            'numberShoppingCart' => $this->number_in_cart,

            'status' => $this->status,
        ];
    }
}
