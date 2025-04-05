<?php

namespace App\Http\Resources\Customer\Membership\V1;

use App\Http\Resources\Customer\Membership\V1\OrderItemStatusResource as CustomerOrderItemStatusResource;
use App\Http\Resources\Customer\Membership\V1\OrderResource as CustomerOrderResource;
use App\Http\Resources\Customer\Membership\V1\ProductBalanceResource as CustomerProductBalanceResource;
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
           'order' => new CustomerOrderResource($this->whenLoaded('order')),
           'productBalance' => new CustomerProductBalanceResource($this->whenLoaded('productBalance')),
           'orderItemStatus' => new CustomerOrderItemStatusResource($this->whenLoaded('orderItemStatus')),
           'status' => $this->status
       ];
    }
}
