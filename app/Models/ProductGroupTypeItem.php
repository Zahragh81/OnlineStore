<?php

namespace App\Models;

class ProductGroupTypeItem extends BaseModel
{
    public function productGroupTypes()
    {
        return $this->belongsToMany(ProductGroupType::class, 'product_group_type_product_group_type_items');
    }
}
