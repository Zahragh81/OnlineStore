<?php

namespace App\Http\Controllers\Customer\Membership\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Membership\V1\ShoppingCartRequest;
use App\Http\Resources\ShoppingCartResource;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $shoppingCartItems = ShoppingCart::with([
            'user',
            'productBalance' => fn($q) => $q->with([
                'product' => fn($q) => $q->with('files'),
                'productBalanceAttributes'
            ])
        ])
            ->where('user_id', $userId)
            ->where('status', true)
            ->get();

        return ShoppingCartResource::collection($shoppingCartItems);
    }


    public function insertUpdate(ShoppingCartRequest $request)
    {
        $userId = Auth::id();

        $input = $request->all();

        $cartItem = ShoppingCart::where('user_id', $userId)
            ->where('product_balance_id', $input['product_balance_id'])
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'unit_price' => $input['unit_price'],
                'number' => $input['number'],
                'status' => $input['status'] ?? $cartItem->status,
            ]);
        } else {
            ShoppingCart::create([
                'user_id' => $userId,
                'product_balance_id' => $input['product_balance_id'],
                'unit_price' => $input['unit_price'],
                'number' => $input['number'],
                'status' => $input['status'] ?? true,
            ]);
        }

        return self::successResponse();
    }


    public function finalPrice()
    {
        $userId = Auth::id();

        $shoppingCartItems = ShoppingCart::where('user_id', $userId)
            ->where('status', true)
            ->get();

        $totalPrice = $shoppingCartItems->sum(fn($item) => $item->total_price);

        return self::successResponse([
            'finalPrice' => $totalPrice
        ]);
    }


    public function destroy(ShoppingCart $shoppingCart)
    {
        $userId = Auth::id();

        if ($shoppingCart->user_id == $userId) {
            $shoppingCart->delete();
            return self::successResponse();
        }
    }

}
