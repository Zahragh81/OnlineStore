<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Transaction extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['invoice_details' => 'json', 'transaction_result' => 'json'];

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::fromCarbon(Carbon::parse($value))->format('Y-m-d H:i:s');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
