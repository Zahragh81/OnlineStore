<?php

namespace App\Models;

class ProductGroupType extends BaseModel
{
    public function productGroupTypeItems()
    {
        return $this->belongsToMany(ProductGroupTypeItem::class, 'product_group_type_product_group_type_items');
    }

    public function storeTypes()
    {
        return $this->belongsToMany(StoreType::class, 'store_type_product_group_types');
    }
}
