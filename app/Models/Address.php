<?php

namespace App\Models;

class Address extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
