<?php

namespace App\Models;

class Product extends BaseModel
{
    public function getPriceAttribute()
    {
        return $this->productBalances()
            ->where('status', true)
            ->min('price');
    }

    public function getMinPriceBalanceAttribute()
    {
        $minPrice = $this->price;

        return $this->productBalances()
            ->where('status', true)
            ->where('price', $minPrice)
            ->first();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model')->where('type', 'files');
    }

    public function productFeatureValues()
    {
        return $this->belongsToMany(ProductFeatureValue::class, 'product_feature_value_products');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function similarProducts()
    {
        return $this->belongsToMany(Product::class, 'similar_products', 'product_id', 'similar_product_id');
    }

    public function productNature()
    {
        return $this->belongsTo(ProductNature::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productBalances()
    {
        return $this->hasMany(ProductBalance::class);
    }

    public function productBalanceAttributes()
    {
        return $this->hasMany(ProductBalanceAttribute::class, 'product_balance_id');
    }

}
