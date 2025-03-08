<?php

namespace App\Http\Controllers\customer\membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductNatureResource;
use App\Models\ProductNature;
use Illuminate\Http\Request;

class ProductNatureController extends Controller
{
    public function __invoke()
    {
        $productNatures = ProductNature::select(['id', 'name', 'store_type_id', 'status'])
            ->with(['logo', 'productNatureAttributes:id,name', 'storeType:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return ProductNatureResource::collection($productNatures);
    }
}
