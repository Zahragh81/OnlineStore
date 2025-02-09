<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\FileResource;
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
            'logo' => new FileResource($this->whenLoaded('logo')),
            'banner' => new FileResource($this->whenLoaded('banner')),

            'city' => new CityResource($this->whenLoaded('city')),
            'storeTypes' => StoreTypeResource::collection($this->whenLoaded('storeTypes'))
        ];
    }
}
