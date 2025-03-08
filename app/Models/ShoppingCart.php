<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends BaseModel
{
    public function getTotalPriceAttribute()
    {
        return $this->unit_price * $this->number;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productBalance()
    {
        return $this->belongsTo(ProductBalance::class);
    }
}
