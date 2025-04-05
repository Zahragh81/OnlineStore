<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends BaseModel
{
    public function logo()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'logo');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
