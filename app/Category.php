<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function foods(){
    	return $this->belongsToMany('App\Category','food__categories','category_id','food_id');
    }
}
