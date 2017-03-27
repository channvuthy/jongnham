<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food_Type extends \Eloquent
{
    
    public function food(){
        return $this->belongsToMany('App\Models\Food');
    }

    public function CountFoodType(){

    	return $this->hasMany('App\Models\CountFoodType');
    }
      public function foods(){
        return $this->belongsToMany('App\Models\Food_Type','category__foods','food_type_id','food_id');
    }
}
