<?php

namespace App\Http\Resources\Shop\Membership;

use App\Http\Resources\Admin\Membership\ProductNatureAttributeResource;
use App\Models\ProductNatureAttributeItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductBalanceAttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $productNatureAttributeType = $this->productNatureAttribute->productNatureAttributeType;

        $value = $productNatureAttributeType->name == 'مجموعه'
            ? $this->value ? ProductNatureAttributeItem::findMany($this->value)->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
            ]) : null
            : (is_array($this->value) ? array_map(fn($v) => ['name' => $v], $this->value) : $this->value);

        return [
            'id' => $this->id,
            'value' => $value,

            'productBalance' => new ProductBalanceResource($this->whenLoaded('productBalance')),
            'productNatureAttribute' => new ProductNatureAttributeResource($this->whenLoaded('productNatureAttribute')),

            'status' => $this->status,
        ];
    }
}
