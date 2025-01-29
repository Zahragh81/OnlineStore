<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Otp extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
