<?php

namespace App\Http\Resources\Shop\Membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_id' => $this->payment_id,
            'final_amount_payable' => $this->final_amount_payable,
            'invoice_details' => $this->invoice_details,
            'transaction_id' => $this->transaction_id,
            'transaction_result' => $this->transaction_result,
            'reference_id' => $this->reference_id,

            'order' => new OrderResource($this->whenLoaded('order')),

            'created_at' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
