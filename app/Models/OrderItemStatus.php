<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemStatus extends BaseModel
{
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
