<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends BaseModel
{
    public function users()
    {
       return $this->hasMany(User::class);
    }
}
