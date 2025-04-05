<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courierType()
    {
        return $this->belongsTo(CourierType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
