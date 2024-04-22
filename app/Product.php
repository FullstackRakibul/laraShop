<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [];
  
    public function category(){
      return $this->hasOne('App\Category','id','product_id');
    }

    public function categories(){
        return $this->belongsTo('App\Category', 'proCategory');
	}
    public function image(){
      return $this->hasOne('App\Productimage','product_id','id')->select('image','product_id','id');
    }
    public function images(){
      return $this->hasMany('App\Productimage','product_id','id')->select('image','product_id','id');
    }
    public function sizes()
    {
        return $this->belongsToMany(Productsize::class, 'productsizes', 'product_id', 'size_id');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'productcolors');
    }
    public function size()
    {
        return $this->belongsToMany(Size::class, 'productsizes');
    }
    public function colors()
    {
        return $this->belongsToMany(Productcolor::class, 'productcolors', 'product_id', 'color_id');
    }
}
