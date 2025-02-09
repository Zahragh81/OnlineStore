<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class ProductNature extends BaseModel
{
    public function logo()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'logo');
    }

    public function productNatureAttributes()
    {
        return $this->belongsToMany(ProductNatureAttribute::class, 'product_nature_product_nature_attributes');
    }

    public function StoreType()
    {
        return $this->belongsTo(StoreType::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
