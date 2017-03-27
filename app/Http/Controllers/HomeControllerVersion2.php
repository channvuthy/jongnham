<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use Auth;
use App\Models\Store;
use App\Models\Gallery;
use DB;
use App\Models\Typeofplace;
use Session;
use App\Models\Typeoffood;
use URL;
use App\Food;
class HomeControllerVersion2 extends Controller
{
    public function index(){
      $foods=Food::orderByRaw("RAND()")->paginate(6);
      $typeoffoods=Typeoffood::all();
      $stores=Store::where('approval','1')->paginate(12);
      $populars=Store::orderBy('view','DESC')->paginate(6);
      return view('version2.index')->with('stores',$stores)->with('typeoffoods',$typeoffoods)->with('foods',$foods)->with('populars',$populars);
    }
    public function getUserConfirmationEmail($key){
      if($user=User::where('register_key',$key)->first()){
         $userAccess=$user;
         $user->verified=1;
         $user->save();
         Auth::login($userAccess);
         $username=Auth::user()->username;
         return redirect()->route('getUserProfile');
      }else{
         return "Access denied";
      }
    }
    
    public function getUserProfile(Request $request){
       $oldUrl=URL::previous();
       $userID=Auth::user()->id;
       $singularUser=User::find($userID);
       return view('version2.userprofile')->with('singularUser',$singularUser)->with('oldUrl',$oldUrl);
    }
    public function postUserLogin(Request $request){
      $oldUrl=URL::previous();
      $email=$request->email;
      $password=$request->password;
      if(Auth::attempt(['email'=>$email,'password'=>$password])){
         if(Auth::user()->verified =="1"){
           return redirect()->to($oldUrl);
         }
         return "<a href='https://mail.google.com/'>Please confirm your email address to login</a>";
      }
      return redirect()->back()->withInput()->withErrors(['message__error'=>'Incorrect Email or Password']);
    }

    public function getEditStore(){
        $id=$_GET['id'];
        $storeArray=explode("keystore",$id);
        $storeID=end($storeArray);
        $userKey=$_GET['key'];
        $userArray=explode("authentication", $userKey);
        $userID=end($userArray);
        if(Auth::user()->id!=$userID){
            return redirect()->route('getUserProfile');
        }
       $authID=Auth::user()->id;
       $singularUser=User::find($authID);
       $store=Store::find($storeID);
       return view('version2.userprofile')->with('singularUser',$singularUser)->with('store',$store);
    }

    public function postUpdateStoreUser(Request $request){
      $fileName=null;
      $store=Store::find($request->id);
     $typeoffood = $request->typeoffood;
      $f=null;
      foreach($typeoffood as $foo){
      $f.=Typeoffood::find($foo)->name.",";
      }
      $f=rtrim($f,",");
      $typeofplace=$request->typeofplace;
      $p=null;
      foreach($typeofplace as $t){
        $p.=Typeofplace::find($t)->placename.",";
      }
      $p=rtrim($p,",");
      $buz=$request->buz;
      $name=$request->name;
      // $from=$request->from;
      // $to=$request->to;
      $email=$request->email;
      $address=$request->address;
      $phone=$request->phone;
      $website=$request->website;
      $maplocation=$request->maplocation;
      $maplat=$request->maplat;
      $maplon=$request->maplon;
      $pricefrom=$request->pricefrom;
      $priceto=$request->priceto;
      $about=$request->about;
      $maplat=$request->maplat;
      $maplon=$request->maplon;
      $gallery=Gallery::all();
      $count=count($gallery);
      if($count>0){
        foreach($gallery as $file){
          $fileName.=$file->fileName."||";
        }
        $fileName=rtrim($fileName,"||");
      }
    
      if(empty($fileName)){
        $store->name=$name;
        $store->phone=$phone;
        $store->website=$website;
        $store->address=$address;
        $store->description=$about;
        // $store->open=$from;
        // $store->close=$to;
        $store->email=$email;
        $store->pricefrom=$pricefrom;
        $store->priceto=$priceto;
        $store->maplat=$maplat;
        $store->maplon=$maplon;
        $store->type_of_food_name=$f;
        $store->type_of_place_name=$p;
        if(!empty($buz)){
            $store->businnesshour=$buz;
        }
        $store->save();
        $store->typeoffoods()->sync($typeoffood);
        $store->places()->sync($typeofplace);
        Gallery::truncate();

        return redirect()->route('getUserProfile')->with('message','Update Page Success');
      }else{
        $store->name=$name;
        $store->images=$fileName;
        $store->phone=$phone;
        $store->website=$website;
        $store->address=$address;
        $store->description=$about;
        // $store->open=$from;
        // $store->close=$to;
        $store->email=$email;
        $store->pricefrom=$pricefrom;
        $store->priceto=$priceto;
        $store->maplat=$maplat;
        $store->maplon=$maplon;
        $store->type_of_food_name=$f;
        $store->type_of_place_name=$p;
        if(!empty($buz)){
            $store->businnesshour=$buz;
        }
        $store->save();
        $store->typeoffoods()->sync($typeoffood);
        $store->places()->sync($typeofplace);
        Gallery::truncate();

        return redirect()->route('getUserProfile')->with('message','Update Page Success');
      }
      
    }

    public function postAddManageUserPage(){
        $userID=Auth::user()->id;
        $singularUser=User::find($userID);
        return view('version2.userprofile')->with('singularUser',$singularUser);
    }

    public function getCheckExistUsrnameOrEmail(Request $request){
        $email=$request->emailorname;
        $store_id=$request->store_id;
        if($user=User::where('email',$email)->first()->id){
         return 1;
        }else{
          return false;
        }
    }

    public function getSaveUserManagmentPage(Request $request){
        $email=$request->emailorname;
        $store_id=$request->store_id;
        if($user=User::where('email',$email)->first()->id){
            $store=Store::find($store_id);
            $store->save();
            if($store->users()->attach($user)){
                return 1;
            }
        }
    }

    public function getRemoveUserFromPage(Request $request){
        $userID=$request->userID;
        $storeID=$request->storeID;
        $user=User::find($userID)->id;
        $store=Store::find($storeID);
        $store->save();
        if($store->users()->detach($user)){
            return 1;
        }

    }
}
