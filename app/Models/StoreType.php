<?php

namespace App\Models;

class StoreType extends BaseModel
{
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_store_types');
    }

    public function productGroupTypes()
    {
        return $this->belongsToMany(ProductGroupType::class, 'store_type_product_group_types');
    }

    public function productNatures()
    {
        return $this->hasMany(ProductNature::class);
    }
}
