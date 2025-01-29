<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Store extends BaseModel
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'store_user');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function logo()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'logo');
    }

    public function banner()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'banner');
    }

    public function storeType()
    {
        return $this->belongsTo(StoreType::class);
    }

}
