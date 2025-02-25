<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class ProductBalanceAttribute extends BaseModel
{
    protected $casts = ['value' => 'json'];

    public function productBalance()
    {
        return $this->belongsTo(ProductBalance::class, 'product_balance_id');
    }

    public function productNatureAttribute()
    {
        return $this->belongsTo(ProductNatureAttribute::class);
    }
}
