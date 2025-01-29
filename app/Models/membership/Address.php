<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
