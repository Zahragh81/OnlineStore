<?php

namespace App\Http\Resources\Shop\Membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'per_unit' => $this->per_unit,
            'total_amount' => $this->total_amount,
            'order' => new OrderResource($this->whenLoaded('order')),
            'productBalance' => new ProductBalanceResource($this->whenLoaded('productBalance')),
            'orderItemStatus' => new OrderItemStatusResource($this->whenLoaded('orderItemStatus')),
            'status' => $this->status
        ];
    }
}
