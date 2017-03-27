<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuFood extends Model
{
    public function store(){
    	return $this->belongsTo('App\Medels\Store');
    }
}
