<?php

namespace App\Models;

class ProductNatureAttributeItem extends BaseModel
{
    public function productNatureAttributes()
    {
        return $this->belongsToMany(ProductNatureAttribute::class, 'product_nature_attribute_product_nature_attribute_items');
    }
}
