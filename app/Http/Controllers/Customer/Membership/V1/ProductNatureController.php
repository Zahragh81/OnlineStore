<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\Membership\V1\ProductNatureResource as CustomerProductNatureResource;
use App\Models\ProductNature;

class ProductNatureController extends Controller
{
    public function __invoke()
    {
        $productNatures = ProductNature::select(['id', 'name', 'store_type_id', 'status'])
            ->with(['logo', 'productNatureAttributes:id,name', 'storeType:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return CustomerProductNatureResource::collection($productNatures);
    }
}
