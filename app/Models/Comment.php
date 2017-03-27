<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
	protected $fillable = ['comment_body'];
    public function store(){
    	return $this->belongsTo('App\Models\Store');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
