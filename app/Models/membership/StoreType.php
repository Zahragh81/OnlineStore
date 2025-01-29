<?php

namespace App\Models\membership;

use App\Models\BaseModel;

class StoreType extends BaseModel
{
    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
