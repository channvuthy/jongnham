<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountFoodType extends Model
{
    public function Food_Type(){
    	return $this->belongsTo('App\Models\Food_Type');
    }
}
