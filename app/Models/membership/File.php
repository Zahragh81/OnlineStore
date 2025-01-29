<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends BaseModel
{
    public function model()
    {
        return $this->morphTo();
    }
}
