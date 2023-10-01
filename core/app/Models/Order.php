<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $with = [
        'product'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function deposit()
    {
        return $this->hasOne(Order::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function shipping()
    {
        return $this->hasOne(ShippingInfo::class,'order_id');
    }
}
