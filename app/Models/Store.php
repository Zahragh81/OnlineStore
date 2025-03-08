<?php

namespace App\Models;

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

    public function productBalances()
    {
        return $this->hasMany(ProductBalance::class);
    }

//    public function products()
//    {
//        return $this->hasMany(Product::class);
//    }
}
