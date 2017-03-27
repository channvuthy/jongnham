<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typeoffood extends Model
{
    public function stores(){
    	return $this->bolongsToMany('App\Models\Store','store__types','typeoffood_id','store_id');
    }
}
