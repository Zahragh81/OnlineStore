<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class Brand extends BaseModel
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
