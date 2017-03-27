<?php

namespace App\Models;
use Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Kyslik\ColumnSortable\Sortable;
class User extends \Eloquent implements AuthenticatableContract
{
   use Authenticatable, Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $sortable = ['id', 'name', 'email', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role(){
        return $this->belongsToMany('Role::class');
    }
     public function stores(){
        return $this->belongsToMany('App\Models\Store','user_stores','user_id','store_id');
    }

    public function saveStore(){
        return $this->belongsToMany('App\Models\Store','user__saves','user_id','store_id');
    }
    public function saveStoreLimit(){
        return $this->belongsToMany('App\Models\Store','user__saves','user_id','store_id')->limit(3);
    }
    public function saveStoreOrderByRating(){
        return $this->belongsToMany('App\Models\Store','user__saves','user_id','store_id')->orderBy('rating','desc');
    }

    public function saveStoreOrderByName(){
        return $this->belongsToMany('App\Models\Store','user__saves','user_id','store_id')->orderBy('name');
    }

   
    public function saveStoreOrderByView(){
        return $this->belongsToMany('App\Models\Store','user__saves','user_id','store_id')->orderBy('view','desc');
    }
    public function saveStoreOrderByPrice(){
        return $this->belongsToMany('App\Models\Store','user__saves','user_id','store_id')->orderBy('priceto','desc');
    }


    public function reviewStore(){
        return $this->belongsToMany('App\Models\Store','user__reviews','user_id','store_id');
    }
    public function reviewStoreLimit(){
        return $this->belongsToMany('App\Models\Store','user__reviews','user_id','store_id')->limit(3);
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function history(){
        return $this->hasMany('App\Models\History');
    }

    public function histories(){
        return $this->belongsToMany('App\Models\Store','histories','user_id','store_id');
    }


    
}
