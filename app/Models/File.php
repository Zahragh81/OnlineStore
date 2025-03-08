<?php

namespace App\Models;

class File extends BaseModel
{
    public function model()
    {
        return $this->morphTo();
    }
}
