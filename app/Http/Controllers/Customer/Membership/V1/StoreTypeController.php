<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\Membership\V1\StoreTypeResource;
use App\Models\StoreType;

class StoreTypeController extends Controller
{
    public function __invoke()
    {
        $storeTypes = StoreType::select(['id', 'name', 'status'])
            ->with(['productGroupTypes:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return StoreTypeResource::collection($storeTypes);
    }

}
