<?php

namespace App\Http\Resources\Customer\Membership\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\Membership\V1\StoreResource as CustomerStoreResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'mobile' => $this->mobile,
            'stores' => CustomerStoreResource::collection($this->whenLoaded('stores'))
        ];
    }
}
