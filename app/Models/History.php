<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function store(){
    	return $this->belongsTo('App\Models\Store');
    }
}
