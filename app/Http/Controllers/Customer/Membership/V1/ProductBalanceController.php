<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\Membership\V1\ProductBalanceResource as CustomerProductBalanceResource;
use App\Models\ProductBalance;
use Illuminate\Http\Request;

class ProductBalanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $productId = $request->input('product_id');

        $productBalances = ProductBalance::select(['id', 'price', 'number', 'status', 'product_id', 'store_id'])
            ->with(['product:id,name', 'store:id,title', 'productBalanceAttributes'])
            ->where('product_id', $productId)
            ->with([
                'productBalanceAttributes' => fn($q) => $q->with('productNatureAttribute')
            ])->get();

        return self::successResponse([
            'productBalances' => CustomerProductBalanceResource::collection($productBalances)
        ]);
    }


}
