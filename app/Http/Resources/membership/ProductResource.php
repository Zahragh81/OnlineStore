<?php

namespace App\Http\Resources\membership;

use App\Http\Resources\FileResource;
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
            'productNature' => new  ProductNatureResource($this->whenLoaded('productNature')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'productFeatureValues' => ProductFeatureValueResource::collection($this->whenLoaded('productFeatureValues')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'status' => $this->status,
        ];
    }
}
