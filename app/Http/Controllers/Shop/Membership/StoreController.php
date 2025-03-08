<?php

namespace App\Http\Controllers\shop\Membership;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Store $store)
    {
        return new StoreResource($store->load(['city:id,name', 'storeTypes:id,name', 'logo', 'banner']));
    }
}
