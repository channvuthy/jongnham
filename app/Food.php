<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function categories(){
    	return $this->belongsToMany('App\Category','food__categories','food_id','category_id');
    }
     public function category(){
    	return $this->belongsToMany('App\Category','food__categories','food_id','category_id');
    }
}
