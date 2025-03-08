<?php

namespace App\Http\Controllers\customer\membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke()
    {
        $stores = Store::select(['id', 'title', 'address', 'postal_code', 'latitude', 'longitude', 'mobile', 'phone', 'owner', 'city_id'])
            ->with(['city:id,name', 'storeTypes:id,name', 'logo', 'banner'])
            ->where(function ($q) {
                $q->where('title', 'like', $this->search);
            })->paginate($this->first);

        return StoreResource::collection($stores);
    }
}
