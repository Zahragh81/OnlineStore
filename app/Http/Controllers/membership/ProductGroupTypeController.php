<?php

namespace App\Http\Controllers\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGroupTypeRequest;
use App\Http\Resources\membership\ProductGroupTypeResource;
use App\Models\membership\ProductGroupType;
use App\Models\membership\ProductGroupTypeItem;
use Illuminate\Http\Request;

class ProductGroupTypeController extends Controller
{
    public function index()
    {
        $productGroupTypes = ProductGroupType::select(['id', 'name', 'status'])
            ->with(['productGroupTypeItems:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return ProductGroupTypeResource::collection($productGroupTypes);
    }


    public function store(ProductGroupTypeRequest $request)
    {
        $input = $request->all();

        $productGroupType = ProductGroupType::create($input);

        if ($request->has('productGroupTypeItems_ids')) {
            $productGroupType->productGroupTypeItems()->sync($request->input('productGroupTypeItems_ids'));
        }

        return self::successResponse();
    }


    public function show(ProductGroupType $productGroupType)
    {
        return new ProductGroupTypeResource($productGroupType->load(['productGroupTypeItems:id,name']));
    }


    public function update(ProductGroupTypeRequest $request, ProductGroupType $productGroupType)
    {
        $input = $request->all();

        $productGroupType->update($input);

        if ($request->has('productGroupTypeItems_ids')) {
            $productGroupType->productGroupTypeItems()->sync($request->input('productGroupTypeItems_ids'));
        }

        return self::successResponse();
    }


    public function destroy(ProductGroupType $productGroupType)
    {
        $productGroupType->productGroupTypeItems()->detach();

        $productGroupType->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'productGroupTypeItems' => ProductGroupTypeItem::select(['id', 'name'])->get()
        ]);
    }
}
