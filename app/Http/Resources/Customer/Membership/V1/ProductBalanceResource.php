<?php

namespace App\Http\Resources\Customer\Membership\V1;

use App\Http\Resources\Customer\Membership\V1\ProductResource as CustomerProductResource;
use App\Http\Resources\Customer\Membership\V1\StoreResource as CustomerStoreResource;
use App\Http\Resources\Customer\Membership\V1\ProductBalanceAttributeResource as CustomerProductBalanceAttributeResource;
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

            'product' => new CustomerProductResource($this->whenLoaded('product')),
            'store' => new CustomerStoreResource($this->whenLoaded('store')),
            'productBalanceAttributes' => CustomerProductBalanceAttributeResource::collection($this->whenLoaded('productBalanceAttributes')),
            'numberShoppingCart' => (int) $this->number_in_cart,

            'status' => $this->status,
        ];
    }
}
