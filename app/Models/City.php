<?php

namespace App\Models;

class City extends BaseModel
{
    public function province()
    {
        return $this->belongsTo(Province::class, 'parent_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'city_id');
    }
}
