<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
       'password' => 'hashed'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_users');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function avatar()
    {
        return $this->morphOne(File::class, 'model');
    }

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
