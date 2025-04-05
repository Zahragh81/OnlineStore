<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class Order extends BaseModel
{
    public function getTotalItemsAttribute()
    {
        return $this->orderItems->sum('total_amount');
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::fromCarbon(Carbon::parse($value))->format('Y-m-d H:i:s');
    }

    public function getShippingTimeAttribute($value)
    {
        return $value ? Jalalian::fromCarbon(Carbon::parse($value))->format('Y-m-d H:i:s') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
