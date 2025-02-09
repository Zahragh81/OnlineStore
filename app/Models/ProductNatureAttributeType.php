<?php

namespace App\Models;

use App\Models\membership\ProductNatureAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductNatureAttributeType extends BaseModel
{
    public function productNatureAttributes()
    {
        return $this->hasMany(ProductNatureAttribute::class, 'product_nature_attribute_type_id');
    }
}
