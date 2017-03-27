<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Store;
use App\Models\User;
use Auth;
class SaveController extends Controller
{
    public function getSave(Request $request){
        $storeID  =  $request->storeID;
        $userID   =  $request->userID;
        $store=Store::find($storeID);
        $exists = $store->userSave->contains($userID);
        if($exists ==false){
            $store->save();
            $store->userSave()->attach($userID);
        }
        return redirect()->back()->withInput()->withErrors(['status'=>'Save Successfully!']);
    }

    public function getDestroy(Request $request){
        $storeID  =  $request->storeID;
        $userID   =  $request->userID;
        $store=Store::find($storeID);
        $exists = $store->userSave->contains($userID);
        if($exists ==true){
            $store->save();
            $store->userSave()->detach($userID);
        }
        return redirect()->back()->withInput()->withErrors(['status'=>'Save Successfully!']);
    }
    public function getSaveAll(Request $request,User $user){
        $users = $user->sortable()->paginate(4);
        return view('version2.save')->withUsers($users);;
    }
    public function postClearAllSaved(Request $request){
        $stores=$request->clearall;
        $storeArray=explode(",", $stores);
        $user=User::find(Auth::user()->id);
        $user->save();
        foreach ($storeArray as $key) {
           $user->saveStore()->detach($key);
        }
        return redirect()->back()->withInput()->withErrors(['message'=>'All store has been cleared']);
       
    }

    public function getClearOnceByOnce(Request $request){
        $storeID=$request->storeID;
        $user=User::find(Auth::user()->id);
        $user->saveStore()->detach($storeID);
        return redirect()->back()->withInput()->withErrors(['message'=>'All store has been cleared']);
    }
}
