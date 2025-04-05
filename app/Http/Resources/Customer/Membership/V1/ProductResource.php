<?php

namespace App\Http\Resources\Customer\Membership\V1;

use App\Http\Resources\Customer\Membership\V1\BrandResource as CustomerBrandResource;
use App\Http\Resources\Customer\Membership\V1\ProductNatureResource as CustomerProductNatureResource;
use App\Http\Resources\Customer\Membership\V1\ProductFeatureValueResource as CustomerProductFeatureValueResource;
use App\Http\Resources\Customer\Membership\V1\FileResource as CustomerFileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_introduction' => $this->product_introduction,
            'minPrice' => $this->price,
            'minPriceStore' => $this->minPriceBalance ? new StoreResource($this->minPriceBalance->store) : null,
            'productNature' => new CustomerProductNatureResource($this->whenLoaded('productNature')),
            'brand' => new CustomerBrandResource($this->whenLoaded('brand')),
            'productFeatureValues' => CustomerProductFeatureValueResource::collection($this->whenLoaded('productFeatureValues')),
            'files' => CustomerFileResource::collection($this->whenLoaded('files')),
            'totalProductBalance' => $this->productBalances->sum('number'),
            'status' => $this->status,
        ];

    }
}
