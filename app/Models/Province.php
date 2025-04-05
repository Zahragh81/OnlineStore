<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends BaseModel
{
    public function cities()
    {
        return $this->hasMany(City::class, 'parent_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
