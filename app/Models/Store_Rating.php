<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store_Rating extends Model
{
    public function store(){
    	return $this->belongsTo('App\Models\Store');
    }
}
