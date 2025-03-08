<?php

namespace App\Models;

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
