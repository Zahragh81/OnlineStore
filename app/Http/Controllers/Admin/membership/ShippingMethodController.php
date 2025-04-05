<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\ShippingMethodRequest;
use App\Http\Resources\Admin\Membership\ShippingMethodResource;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $shippingMethods = ShippingMethod::select(['id', 'title', 'price', 'status'])
            ->where(fn($q) => $q->where('title', 'like', $this->search))
            ->paginate($this->first);

        return ShippingMethodResource::collection($shippingMethods);
    }


    public function store(ShippingMethodRequest $request)
    {
        $input = $request->all();

        ShippingMethod::create($input);

        return self::successResponse();
    }


    public function show(ShippingMethod $shippingMethod)
    {
        return new ShippingMethodResource($shippingMethod);
    }


    public function update(ShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        $input = $request->all();

        $shippingMethod->update($input);

        return self::successResponse();
    }


    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();

        return self::successResponse();
    }
}
