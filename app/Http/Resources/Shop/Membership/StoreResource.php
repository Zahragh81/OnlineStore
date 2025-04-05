<?php

namespace App\Http\Resources\Shop\Membership;

use App\Http\Resources\Shop\Membership\CityResource as ShopCityResource;
use App\Http\Resources\Shop\Membership\FileResource as ShopFileResource;
use App\Http\Resources\Shop\Membership\StoreTypeResource as ShopStoreTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'owner' => $this->owner,
            'status' => $this->status,
            'logo' => new ShopFileResource($this->whenLoaded('logo')),
            'banner' => new ShopFileResource($this->whenLoaded('banner')),

            'city' => new ShopCityResource($this->whenLoaded('city')),
            'storeTypes' => ShopStoreTypeResource::collection($this->whenLoaded('storeTypes'))
        ];
    }
}
