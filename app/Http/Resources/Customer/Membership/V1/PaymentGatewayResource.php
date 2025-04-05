<?php

namespace App\Http\Resources\Customer\Membership\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Customer\Membership\V1\FileResource as CustomerFileResource;

class PaymentGatewayResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'merchant_id' => $this->merchant_id,
            'terminal_id' => $this->terminal_id,
            'secret_key' => $this->secret_key,
            'logo' => new CustomerFileResource($this->whenLoaded('logo')),
            'status' => $this->status
        ];
    }
}
