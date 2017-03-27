<?php

namespace App\Models;
use App\Models\Food_Type;

use Illuminate\Database\Eloquent\Model;

class Food extends \Eloquent
{
    
    public function food_type(){
         return $this->belongsTo('App\Models\Food_Type','type_id');
    }


    public function multiCate($data){
    	$cats=Null;
    	$explode=explode(",", $data);
    	foreach ($explode as $value) {
    		$cats.=\App\Models\Food_Type::where('id',$value)->first()->id.",";
    	}
    	return rtrim($cats,",");
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Food_Type','category__foods','food_id','food_type_id');
    }
}
