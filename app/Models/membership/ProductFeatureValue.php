<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class ProductFeatureValue extends BaseModel
{
    protected $casts = ['value' => 'json'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_feature_value_products');
    }

    public function productNatureAttribute()
    {
        return $this->belongsTo(ProductNatureAttribute::class);
    }
}
