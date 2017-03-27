<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Store;
use DB;
use App\Models\Store_Rating;
use App\Models\History;
use Auth;
class RestaurantController extends Controller
{
    
    public function getRestaurantDetail(Request $request){ 
        $restuarantdetail=Store::find($request->id);
        $ifNotEmpy=Store_Rating::find($restuarantdetail->id);
        if (empty($ifNotEmpy)) { 
         $avg = DB::table('store__ratings')
        ->select(DB::raw('avg(store__ratings.rating) as avg'))
        ->where('store_id','=',$restuarantdetail->id)
        ->groupBy('store_id')
        ->first();
        }

        if(Auth::check()){
            $userId=Auth::user()->id;
            $history=new History();
            $history->user_id=$userId;
            $history->store_id=$request->id;
            $ifTheSameHistory=DB::select("SELECT * FROM histories WHERE user_id={$userId} AND store_id={$request->id}");
            if(count($ifTheSameHistory)<=0){
                $history->save();
            }
        }
        $recommendeds=Store::where('recommended','1')->get();
        return view('version2.restuarantdetail')->with('restuarantdetail',$restuarantdetail)->with('recommendeds',$recommendeds);
    }

    public function getView(Request $request){
        $storeID=$request->id;
        $click=$request->click;
        $store=Store::find($storeID);
        $view=$store->view;
        $totalView=$view+$click;
        $store->view=$totalView;
        $store->save();
        return $totalView;
    }


    public function getCalendar(Request $request){
        $hours = eval("return {$request->calendar};");
        return view('version2.getcalendar')->with('hours',$hours);
    }

    public function getWorkingTime(Request $request){
         $hours = eval("return {$request->calendar};");
        return view('version2.workingtime')->with('hours',$hours);
    }
}
