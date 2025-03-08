<?php

namespace App\Models;

class Gender extends BaseModel
{
    public function users()
    {
       return $this->hasMany(User::class);
    }
}
