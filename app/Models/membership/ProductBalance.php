<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class ProductBalance extends BaseModel
{
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
}
