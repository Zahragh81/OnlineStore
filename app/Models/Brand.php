<?php

namespace App\Models;

class Brand extends BaseModel
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
