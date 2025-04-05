<?php

namespace App\Http\Resources\Customer\Membership\V1;

use App\Http\Resources\Admin\Membership\CourierResource;
use App\Http\Resources\Customer\Membership\V1\ShippingMethodResource as CustomerShippingMethodResource;
use App\Http\Resources\Customer\Membership\V1\OrderStatusResource as CustomerOrderStatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'shipping_cost' => $this->shipping_cost,
            'discount' => $this->discount,
            'final_amount_payable' => $this->final_amount_payable,
            'shippingMethod' => new CustomerShippingMethodResource($this->whenLoaded('shippingMethod')),
            'orderStatus' => new CustomerOrderStatusResource($this->whenLoaded('orderStatus')),
            'courier' => new CourierResource($this->whenLoaded('courier')),
            'shipment_code' => $this->shipment_code,
            'shipping_company_name' => $this->shipping_company_name,
            'shipping_time' => $this->shipping_time,
            'order_date' => $this->created_at,
            'pay_status' => $this->pay_status,
            'status' => $this->status,
        ];
    }
}
