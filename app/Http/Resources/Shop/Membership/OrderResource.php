<?php

namespace App\Http\Resources\Shop\Membership;

use App\Http\Resources\Admin\Membership\CourierResource;
use App\Http\Resources\Shop\Membership\ShippingMethodResource as ShopShippingMethodResource;
use App\Http\Resources\Shop\Membership\UserResource as ShopUserResource;
use App\Http\Resources\Shop\Membership\ProvinceResource as ShopProvinceResource;
use App\Http\Resources\Shop\Membership\CityResource as ShopCityResource;
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'address_2' => $this->address_2,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'postal_code' => $this->postal_code,
            'shipment_code' => $this->shipment_code,
            'shipping_company_name' => $this->shipping_company_name,
            'user' => new ShopUserResource($this->whenLoaded('user')),
            'courier' => new CourierResource($this->whenLoaded('courier')),
            'shippingMethod' => new ShopShippingMethodResource($this->whenLoaded('shippingMethod')),
            'province' => new ShopProvinceResource($this->whenLoaded('province')),
            'city' => new ShopCityResource($this->whenLoaded('city')),
            'orderStatus' => new OrderStatusResource($this->whenLoaded('orderStatus')),
            'total_items' => $this->total_items,
            'shipping_time' => $this->shipping_time,
            'order_date' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
