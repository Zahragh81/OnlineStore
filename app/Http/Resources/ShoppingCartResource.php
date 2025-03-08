<?php

namespace App\Http\Resources;

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
            'user' => new UserResource($this->whenLoaded('user')),
            'productBalance' => new ProductBalanceResource($this->whenLoaded('productBalance')),
            'status' => $this->status,
        ];
    }
}
