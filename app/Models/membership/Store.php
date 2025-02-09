<?php

namespace App\Models\membership;

use App\Models\BaseModel;
use App\Models\User;

class Store extends BaseModel
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'store_users');
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

    public function storeTypes()
    {
        return $this->belongsToMany(StoreType::class, 'store_store_types');
    }

}
