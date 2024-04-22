<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
   protected $guarded = [];
   
   public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
   public function statustype()
    {
        return $this->belongsTo(Ordertype::class, 'status');
    }
}
