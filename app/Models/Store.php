<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Store extends Model
{
  protected $fillable=['name','phone','website','images','address','description','open','close','status','store_type','typeoffood_id','typeofplace_id','email','maplat','maplon','mapfrom','mapto','distance','created_at','updated_at','pricefrom','priceto','view','recommended','approval','rating','total_rating','total_rates','businnesshour','type_of_place_name','type_of_food_name','import_date','upload_type'];
   protected  $table="stores";
    use Sortable;
    public $sortable = ['id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at'];

    public function users(){
    	return $this->belongsToMany('App\Models\User','user_stores','store_id','user_id');
    }

    public function menufoods(){
    	return $this->hasMany('App\Models\MenuFood','store_id');
    }
    public function storeRating(){
    	return $this->hasMany('App\Models\Store_Rating','store_id');
    }

    public function userSave(){
    	return $this->belongsToMany('App\Models\User','user__saves','store_id','user_id');
    }
    public function userReview(){
    	return $this->belongsToMany('App\Models\User','user__reviews','store_id','user_id');
    }

    public function userSearchReview(){
       return $this->belongsToMany('App\Models\User','user__reviews','store_id','user_id')->where(Auth::user()->id);
    }

    public function comments(){
    	return $this->hasMany('App\Models\Comment');
    }

    public function history(){
        return $this->hasMany('App\Models\History','store_id');
    }

    public function histories(){
        return $this->belongsToMany('App\Models\User','histories','store_id','user_id');
    }

    public function typeoffoods(){
        return $this->belongsToMany('App\Models\Typeoffood','store__types','store_id','typeoffood_id');
    }

    public function places(){
        return $this->belongsToMany('App\Models\Typeofplace','store_places','store_id','typeofplace_id');
    }

}
