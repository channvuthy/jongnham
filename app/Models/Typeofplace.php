<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typeofplace extends Model
{
    public function store(){
    	return $this->hasMany('App\Models\Typeofplace');
    }
    public function stores(){
        return $this->belongsToMany('App\Models\Typeofplace','store_places','typeofplaces_id','store_id');
    }
}
