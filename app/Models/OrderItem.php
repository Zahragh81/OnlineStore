<?php

namespace App\Models;

class OrderItem extends BaseModel
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productBalance()
    {
        return $this->belongsTo(ProductBalance::class);
    }

    public function orderItemStatus()
    {
        return $this->belongsTo(OrderItemStatus::class);
    }
}
