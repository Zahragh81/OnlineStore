<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\ProductNatureAttributeType;

class ProductNatureAttribute extends BaseModel
{
    public function productNatureAttributeItems()
    {
        return $this->belongsToMany(ProductNatureAttributeItem::class, 'product_nature_attribute_product_nature_attribute_items');
    }

    public function productNatures()
    {
        return $this->belongsToMany(ProductNature::class, 'product_nature_product_nature_attributes');
    }

    public function productNatureAttributeType()
    {
        return $this->belongsTo(ProductNatureAttributeType::class);
    }

    public function productFeatureValues()
    {
        return $this->hasMany(ProductFeatureValue::class);
    }
}
