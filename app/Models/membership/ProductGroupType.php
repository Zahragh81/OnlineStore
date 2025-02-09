<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
