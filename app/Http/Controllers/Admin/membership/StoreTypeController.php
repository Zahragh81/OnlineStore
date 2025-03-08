<?php

namespace App\Http\Controllers\admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\StoreTypeRequest;
use App\Http\Resources\StoreTypeResource;
use App\Models\ProductGroupType;
use App\Models\StoreType;

class StoreTypeController extends Controller
{
    public function index()
    {
        $storeTypes = StoreType::select(['id', 'name', 'status'])
            ->with(['productGroupTypes:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return StoreTypeResource::collection($storeTypes);
    }


    public function store(StoreTypeRequest $request)
    {
        $input = $request->all();

        $storeType = StoreType::create($input);

        if ($request->has('productGroupType_ids')) {
            $storeType->productGroupTypes()->sync($request->input('productGroupType_ids'));
        }

        return self::successResponse();
    }


    public function show(StoreType $storeType)
    {
        return new StoreTypeResource($storeType->load('productGroupTypes:id,name'));
    }


    public function update(StoreTypeRequest $request, StoreType $storeType)
    {
        $input = $request->all();

        $storeType->update($input);

        if ($request->has('productGroupType_ids')) {
            $storeType->productGroupTypes()->sync($request->input('productGroupType_ids'));
        }

        return self::successResponse();

    }

    public function destroy(StoreType $storeType)
    {
        $storeType->productGroupTypes()->detach();

        $storeType->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'productGroupTypes' => ProductGroupType::select(['id', 'name'])->get()
        ]);
    }
}
