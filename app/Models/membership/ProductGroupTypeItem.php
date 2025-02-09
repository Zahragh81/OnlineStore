<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroupTypeItem extends BaseModel
{
    public function productGroupTypes()
    {
        return $this->belongsToMany(ProductGroupType::class, 'product_group_type_product_group_type_items');
    }
}
