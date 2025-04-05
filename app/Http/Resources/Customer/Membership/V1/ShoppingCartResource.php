<?php

namespace App\Http\Resources\Customer\Membership\V1;

use App\Http\Resources\Customer\Membership\V1\UserResource as CustomerUserResource;
use App\Http\Resources\Customer\Membership\V1\ProductBalanceResource as CustomerProductBalanceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingCartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unit_price' => $this->unit_price,
            'number' => $this->number,
            'totalPrice' => $this->total_price,
            'user' => new CustomerUserResource($this->whenLoaded('user')),
            'productBalance' => new CustomerProductBalanceResource($this->whenLoaded('productBalance')),
            'status' => $this->status,
        ];
    }
}
