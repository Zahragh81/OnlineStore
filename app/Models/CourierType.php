<?php

namespace App\Models;

class CourierType extends BaseModel
{
    public function couriers()
    {
        return $this->hasMany(Courier::class);
    }
}
