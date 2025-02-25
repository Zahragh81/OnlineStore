<?php

namespace App\Http\Controllers\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductBalanceRequest;
use App\Http\Resources\membership\ProductBalanceAttributeResource;
use App\Http\Resources\membership\ProductBalanceResource;
use App\Http\Resources\membership\ProductNatureResource;
use App\Http\Resources\membership\ProductResource;
use App\Http\Resources\membership\StoreTypeResource;
use App\Models\membership\Product;
use App\Models\membership\ProductBalance;
use App\Models\membership\Store;
use Illuminate\Http\Request;

class ProductBalanceController extends Controller
{
    public function index()
    {
        $ProductBalances = ProductBalance::select(['id', 'price', 'number', 'status', 'product_id', 'store_id'])
            ->with(['product:id,name', 'store:id,title', 'productBalanceAttributes'])
            ->paginate($this->first);

        return ProductBalanceResource::collection($ProductBalances);
    }


    public function store(ProductBalanceRequest $request)
    {
        $input = $request->all();
        \Log::info($input);

        $input['store_id'] = 4;

        $productBalance = ProductBalance::create($input);
        \Log::info($productBalance);

        if ($request->has('productBalanceAttributes')) {
            foreach ($request->input('productBalanceAttributes') as $featureValue) {
                $productBalance->productBalanceAttributes()->create([
                    'product_balance_id' => $productBalance->id,
                    'product_nature_attribute_id' => $featureValue['product_nature_attribute_id'],
                    'value' => $featureValue['value'],
                ]);
            }
        }

        return self::successResponse();

    }


    public function show(ProductBalance $productBalance)
    {
        return new ProductBalanceResource($productBalance->load(['product:id,name', 'store:id,title', 'productBalanceAttributes']));
    }


    public function update(ProductBalanceRequest $request, ProductBalance $productBalance)
    {
        $input = $request->all();

        $input['store_id'] = 1;

        $productBalance->update($input);

        if ($request->has('productBalanceAttributes')) {
            foreach ($request->input('productBalanceAttributes') as $featureValue) {
                $existingFeatureValue = $productBalance->productBalanceAttributes()
                    ->where('product_nature_attribute_id', $featureValue['product_nature_attribute_id'])
                    ->first();

                if ($existingFeatureValue) {
                    $existingFeatureValue->update([
                        'value' => $featureValue['value']
                    ]);
                } else {
                    $productBalance->productBalanceAttributes()->create([
                        'product_balance_id' => $productBalance->id,
                        'product_nature_attribute_id' => $featureValue['product_nature_attribute_id'],
                        'value' => $featureValue['value']
                    ]);
                }
            }
        }

        return self::successResponse();
    }


    public function destroy(ProductBalance $productBalance)
    {
        foreach ($productBalance->productBalanceAttributes as $featureValue) {
            $featureValue->delete();
        }

        $productBalance->delete();

        return self::successResponse();
    }


    public function product(Request $request)
    {
        $storeTypeId = $request->input('store_type_id');
        \Log::info($storeTypeId);

        $products = Product::select(['id', 'name', 'product_introduction', 'product_nature_id', 'brand_id'])
            ->with(['productNature:id,name', 'brand:id,name', 'productFeatureValues', 'files'])
            ->whereHas('productNature', fn($q) => $q->whereHas('storeType', fn($subQuery) => $subQuery->where('id', $storeTypeId)))
            ->get();

        \Log::info($products);

        return ProductResource::collection($products);
    }


    public function storeType()
    {
        $storeId = 4;

        $storeTypes = Store::find($storeId)
            ->storeTypes()
            ->select(['id', 'name'])
            ->get();

        return StoreTypeResource::collection($storeTypes);
    }


    public function productNatureAttribute(Request $request)
    {
        $productId = $request->input('product_id');

        $product = Product::select(['id', 'name', 'product_introduction', 'product_nature_id', 'brand_id'])
            ->with([
                'productNature' => fn($q) => $q->with([
                    'productNatureAttributes' => fn($q) => $q->wherePivot('admin_panel', true)
                        ->with('productNatureAttributeItems:id,name')
                ]),
                'brand:id,name',
                'productFeatureValues',
                'files'
            ])->findOrFail($productId);

        return self::successResponse([
            'product' => new ProductResource($product)
        ]);
    }


    public function productNatureAttributesNonAdminPanel(Request $request)
    {
        $productId = $request->input('product_id');

        $product = Product::select(['id', 'name', 'product_introduction', 'product_nature_id', 'brand_id'])
            ->with([
                'productNature' => fn($q) => $q->with([
                    'productNatureAttributes' => fn($q) => $q->wherePivot('admin_panel', false)
                        ->with('productNatureAttributeItems:id,name')
                ]),
                'brand:id,name',
                'productFeatureValues',
                'files'
            ])->findOrFail($productId);

        $productNature = $product->productNature;

        return self::successResponse([
            'productNature' => new ProductNatureResource($productNature),
        ]);
    }


    public function productBalanceAttribute(Request $request)
    {
        $productId = $request->input('product_id');

        $productBalances = ProductBalance::select(['id', 'price', 'number', 'status', 'product_id', 'store_id'])
            ->with(['product:id,name', 'store:id,title', 'productBalanceAttributes'])
            ->where('product_id', $productId)
            ->with([
                'productBalanceAttributes' => fn($q) => $q->with([
                    'productNatureAttribute' => fn($q) => $q->with('productNatureAttributeItems')
                ])
            ])->get();

        return self::successResponse([
            'productBalances' => ProductBalanceResource::collection($productBalances)
        ]);
    }
}
