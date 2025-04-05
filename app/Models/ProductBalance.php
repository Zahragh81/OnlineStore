<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

class ProductBalance extends BaseModel
{
    public function getNumberInCartAttribute()
    {
        $user = Auth::user();
        if ($user) {
            return $this->shoppingCarts()->where('user_id', $user->id)->sum('number');
        }
        return 0;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productBalanceAttributes()
    {
        return $this->hasMany(ProductBalanceAttribute::class, 'product_balance_id');
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
