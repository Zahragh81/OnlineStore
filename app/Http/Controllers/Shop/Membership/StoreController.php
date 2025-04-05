<?php

namespace App\Http\Controllers\Shop\Membership;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shop\Membership\StoreResource as ShopStoreResource;
use App\Models\Store;

class StoreController extends Controller
{
    public function __invoke(Store $store)
    {
        return new ShopStoreResource($store->load(['city:id,name', 'storeTypes:id,name', 'logo', 'banner']));
    }
}
