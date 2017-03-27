<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Session;
use Auth;
use \File;
use App\Models\MenuFood;
use App\Models\Store;
use App\Models\Gallery;
use App\Models\Store_Rating;
use App\Models\Store_Type;
use App\Models\Typeoffood;
use App\Models\Typeofplace;
class UserController extends Controller
{ 
    public function postRegister(Request $request){
      $this->validate($request,[
         'email'=>'required|unique:users',
         'password'=>'required|min:5',
         'cpassword'=>'required|min:5',
      ]);
      
      $user=new User();
      $string = $request->email;
      $string = substr($string, 0, strpos($string, '@'));
      $fullname= preg_replace('/[0-9]+/', '', $string);
      $user->username=$fullname;
      $user->email=$request->email;
      $user->password=bcrypt($request->password);
      $user->permission="3";
      $user->permission_type="User";
      $registerkey=bcrypt($request->email);
      $registerkey=str_replace("/","",$registerkey);
      $user->register_key=$registerkey;
      $user->save();
      $to =$request->email;
      $subject = "Confirmation Email";
      $message = "
      <html>
      <head>
      <title>Jongnhams.com-Please Confirmation Email!</title>
      </head>
      <body>
      <p>Welcome to Jongnhams - the best website where you can find awesome restaurants in Phnom Penh.</p>
      <p>To activate your account, please
      <a href='http://jongnhams.com/user/confirm/email/key/".$registerkey."'>Click Here</a></p>
      <br/>
      Please visit us by our website www.jongnhams.com 
      <br/>
      or our Facebook Page www.facebook.com/jongnhams
      </body>
      </html>
      ";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= 'From: <info@jongnhams.com>' . "\r\n";
      if(mail($to,$subject,$message,$headers)){
         return redirect()->route('home.version2.index')->withInput()->withErrors(['message'=>'Please confirm your Email Address']);
      }
    }
    public function postUserUpdateProfile(Request $request){
      $username=$request->username;
      $email=$request->email;
      $password=$request->password;
      $sex=$request->sex;
      $phone=$request->phone;
      $dob=$request->dob;
      $address=$request->address;
      $id=$request->id;
      $user=User::find($id);
      $user->username=$username;
      $user->email=$email;
      $user->password=bcrypt($password);
      $user->sex=$sex;
      $user->phone=$phone;
      $user->date_of_birth=$dob;
      $user->address=$address;
      $user->save();
      return redirect()->route('getUserProfile');
      
    
    }
    
    public function postUserChangeImage(Request $request){

      $files=$request->file('files');
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }
        $imageString=rtrim($imageString,"||");
        $user=User::find($request->id);
        $user->photo=$imageString;
        $user->account_type="0";
        $user->save();
        return redirect()->route('getUserProfile');
    }
    public function postSaveRestaurant(Request $request){
      
      $store=new Store();
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
      $name=$request->name;
      $buz=$request->buz;
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
      $imageGallery=null;
      foreach($gallery as $image){
        $imageGallery.=$image->fileName."||";
      }
      $imageGallery=rtrim($imageGallery,"||");
      Gallery::truncate();
      $store->name=$name;
      $store->phone=$phone;
      $store->images=$imageGallery;
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
      $store->businnesshour=$buz;
      $store->save();
      $store->users()->attach(Auth::user()->id);
      foreach($typeoffood as $type){
        $types=Typeoffood::find($type)->id;
        $store->typeoffoods()->attach($types);
      }
      foreach($typeofplace as $place){
        $types=Typeofplace::find($place)->id;
        $store->places()->attach($types);
      }
      return redirect()->route('getUserProfile')->with('message','Page has been created!!');
      
    }
    
    public function postSaveFood(Request $request){
      $name=$request->name;
      $price=$request->price;
      $description=$request->description;
      $file = $request->file('photo');
      $selectpage=$request->selectpage;
      $fileName=rand(1111,9999)."".$file->getClientOriginalName();
      $menufood=new MenuFood();
      $menufood->name=$name;
      $menufood->price=$price;
      $menufood->image=$fileName;
      $menufood->description=$description;
      $menufood->store_id=$selectpage;
      $menufood->save();
      $file->move('uploads',$fileName);
      return redirect()->back()->with('message','Foods Created Success');

    }

    public function getAjaxUpdateFood(Request $request){
      $name=$request->name;
      $price=$request->price;
      $description=$request->description;
      $id=$request->id;
      $menufood=MenuFood::find($id);
      $menufood->name=$name;
      $menufood->price=$price;
      $menufood->description=$description;
      $menufood->save();
      return "Success";

    }

    public function postChangeImageFood(Request $request){
      $this->validate($request,[
        'photo'=>'required'
      ]);
      $file=$request->file('photo');
      $storeID=$request->id;
      $menufood=MenuFood::find($storeID);
      $fileName=rand(1111,9999)."".$file->getClientOriginalName();
      $file->move('uploads',$fileName);
      $menufood->image=$fileName;
      $menufood->save();
      return redirect()->back();
    }

    public function deletepostimagestore(Request $request){
      $id=$request->id;
      $menufood=MenuFood::find($id);
      $menufood->delete();
    }

}


?>