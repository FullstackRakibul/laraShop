<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function division(){
    	return $this->belongsTo('App\Division');
    }

    public function areas(){
    	return $this->hasMany('App\Area')->where('status',1);
    }
}
