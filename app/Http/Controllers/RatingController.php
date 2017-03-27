<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Store_Rating;

class RatingController extends Controller
{
   public function getRating(Request $request){
   	$storeRating = new Store_Rating();
   	$storeRating->store_id=$request->id;
   	$storeRating->rating=$request->rate;
   	$storeRating->save();
   	return redirect()->back();
   }
}
