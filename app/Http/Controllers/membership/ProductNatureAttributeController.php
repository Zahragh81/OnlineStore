<?php

namespace App\Http\Controllers\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductNatureAttributeRequest;
use App\Http\Resources\membership\ProductNatureAttributeResource;
use App\Models\membership\ProductNatureAttribute;
use App\Models\membership\ProductNatureAttributeItem;
use App\Models\ProductNatureAttributeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\select;

class ProductNatureAttributeController extends Controller
{
    public function index()
    {
        $productNatureAttributes = ProductNatureAttribute::select(['id', 'name', 'description', 'product_nature_attribute_type_id', 'status'])
            ->with(['productNatureAttributeType:id,name', 'productNatureAttributeItems:id,name'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search);
            })->paginate($this->first);

        return ProductNatureAttributeResource::collection($productNatureAttributes);
    }


    public function store(ProductNatureAttributeRequest $request)
    {
        $input = $request->all();
        Log::info($input);

        $productNatureAttributes = ProductNatureAttribute::create($input);

        if ($input['product_nature_attribute_type_id'] == 2 && $request->has('productNatureAttributeItem_ids')) {
            $productNatureAttributes->productNatureAttributeItems()->sync($request->input('productNatureAttributeItem_ids'));
        }

        return self::successResponse();
    }


    public function show(ProductNatureAttribute $productNatureAttribute)
    {
        return new ProductNatureAttributeResource($productNatureAttribute->load(['productNatureAttributeType:id,name', 'productNatureAttributeItems:id,name']));
    }


    public function update(ProductNatureAttributeRequest $request, ProductNatureAttribute $productNatureAttribute)
    {
        $input = $request->all();

        $productNatureAttribute->update($input);

        if ($input['product_nature_attribute_type_id'] == 2 && $request->has('productNatureAttributeItem_ids')) {
            $productNatureAttribute->productNatureAttributeItems()->sync($request->input('productNatureAttributeItem_ids'));
        } else {
            $productNatureAttribute->productNatureAttributeItems()->detach();
        }

        return self::successResponse();
    }


    public function destroy(ProductNatureAttribute $productNatureAttribute)
    {
        $productNatureAttribute->productNatureAttributeItems()->detach();

        $productNatureAttribute->delete();

        return self::successResponse();
    }


    public function upsertData()
    {
        return self::successResponse([
            'ProductNatureAttributeTypes' => ProductNatureAttributeType::select(['id', 'name'])->get(),
            'ProductNatureAttributeItems' => ProductNatureAttributeItem::select(['id', 'name'])->get()
        ]);
    }
}
