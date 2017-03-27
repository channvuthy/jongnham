<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Store;

class JqueryRaing extends Controller
{
    
    public function getRating(Request $request){
    	$rate=$request->rate;
    	$id=$request->idBox;
    	$store=Store::find($id);
    	$old_totalRating=$store->total_rating;
    	$total_rates=$store->total_rates;

    	$current_rating=$old_totalRating+$rate;
		$new_totalRates=$total_rates+1;
		$newRating=$current_rating/$new_totalRates;
		$store->rating=$newRating;
		$store->total_rating=$current_rating;
		$store->total_rates=$new_totalRates;
		$store->save();
    }
}
