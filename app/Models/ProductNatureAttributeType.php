<?php

namespace App\Models;

class ProductNatureAttributeType extends BaseModel
{
    public function productNatureAttributes()
    {
        return $this->hasMany(ProductNatureAttribute::class, 'product_nature_attribute_type_id');
    }
}
