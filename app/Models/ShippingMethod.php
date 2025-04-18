<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends BaseModel
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
