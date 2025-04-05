<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\Membership\V1\ProductResource as CustomerProductResource;
use App\Http\Resources\Customer\Membership\V1\StoreResource as CustomerStoreResource;
use App\Http\Resources\Customer\Membership\V1\ProductBalanceResource as CustomerProductBalanceResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select(['id', 'name', 'product_introduction', 'product_nature_id', 'brand_id'])
            ->with(['productNature:id,name', 'brand:id,name', 'productFeatureValues', 'files'])
            ->where(function ($q) {
                $q->where('name', 'like', $this->search)
                    ->orWhereHas('brand', function ($query) {
                        $query->where('name', 'like', $this->search);
                    });
            })
            ->paginate($this->first);

        return CustomerProductResource::collection($products);
    }


    public function productDetail(Request $request)
    {
        $productId = $request->input('product_id');
        $storeId = $request->input('store_id');

        $product = Product::with([
            'productNature:id,name',
            'brand:id,name',
            'productFeatureValues',
            'files',
        ])->findOrFail($productId);

        $minStoreBalance = $product->productBalances()
            ->where('status', true)
            ->where('store_id', $storeId)
            ->get();

        $otherStores = $product->productBalances()
            ->where('status', true)
            ->where('store_id', '!=', $storeId)
            ->orderBy('price')
            ->take(5)
            ->get();

        $relatedProducts = Product::whereHas('relatedProducts', fn($q) => $q->where('product_id', $productId))
            ->select(['id', 'name'])
            ->get();

        $similarProducts = Product::whereHas('similarProducts', fn($q) => $q->where('product_id', $productId))
            ->select(['id', 'name'])
            ->get();


        return self::successResponse([
            'product' => new CustomerProductResource($product),
            'storeProductBalances' => CustomerProductBalanceResource::collection($minStoreBalance->load(['productBalanceAttributes', 'store:id,title'])),
            'otherStores' => $otherStores->map(fn($balance) => [
                'store' => new CustomerStoreResource($balance->store),
                'price' => $balance->price
            ]),
            'relatedProducts' => CustomerProductResource::collection($relatedProducts),
            'similarProducts' => CustomerProductResource::collection($similarProducts),
        ]);
    }

}
