<?php

namespace App\Http\Resources\Customer\Membership\V1;

use App\Http\Resources\Customer\Membership\V1\CityResource as CustomerCityResource;
use App\Http\Resources\Customer\Membership\V1\FileResource as CustomerFileResource;
use App\Http\Resources\Customer\Membership\V1\StoreTypeResource as CustomerStoreTypeResource;
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
            'logo' => new CustomerFileResource($this->whenLoaded('logo')),
            'banner' => new CustomerFileResource($this->whenLoaded('banner')),

            'city' => new CustomerCityResource($this->whenLoaded('city')),
            'storeTypes' => CustomerStoreTypeResource::collection($this->whenLoaded('storeTypes'))
        ];
    }
}
