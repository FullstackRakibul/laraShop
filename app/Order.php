<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
   protected $guarded = [];
   
    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class, 'order_id')->orderBy('updated_at', 'desc');
    }

    public function orderDetails() : HasOne
    {
        return $this->hasOne(Orderdetails::class,'orderId','orderIdPrimary');
    }

    public function customer() : HasOne
    {
        return $this->hasOne(Orderdetails::class,'orderId','orderIdPrimary');
    }
}
