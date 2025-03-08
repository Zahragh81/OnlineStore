<?php

namespace App\Models;

class City extends BaseModel
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function stores()
    {
     return $this->hasMany(Store::class);
    }
}
