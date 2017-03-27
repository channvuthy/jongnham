<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use DB;
use App\Models\User;
use App\Food;
use App\Models\Location;
use App\Models\Region;
use App\Models\Store_Type;
use App\Models\Store;
use App\Models\Menu;
use App\Models\Food_Type;
use App\Category;
use Auth;
use File;
use App\Models\Typeoffood;
use App\Models\Typeofplace;

use App\Models\Gallery;
class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function profile(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:users',
            'password'=>'required'
        ]);
        $email=$request['email'];
        $password=$request['password'];
        if(\Auth::attempt(['email'=>$email,'password'=>$password])){
            return redirect()->route('dashboard');
        }else{
            return back()->withInput()->withErrors(['password'=>'Password is Incorrect']);
        }
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function updateprofile($user){
        $userprofile=DB::table('users')->where('id','=',$user)->first();
        return view('admin.updateprofile')->with('user',$userprofile);
    }
    public function updateuser(Request $request){
        $this->validate($request,[
            'password'=>'required|min:6'
        ]);
        $username=$request->username;
        $email=$request->email;
        $password=bcrypt($request->password);
        $sex=$request->sex;
        $phone=$request->phone;
        $date_of_birth=$request->date_of_birth;
        $address=$request->address;
        $file=$request->file('photo');
        $rand_file=md5(rand(1111,9999));
        $new_file=$request->photo;
        if(!empty($file)){
            $file_name=$file->getClientOriginalName();
            $new_file=$rand_file.$file_name;
            $file->move('uploads',$new_file);
        }
        $user=User::find($request->user_id);
        $user->username=$username;
        $user->email=$email;
        $user->password=$password;
        $user->sex=$sex;
        $user->phone=$phone;
        $user->date_of_birth=$date_of_birth;
        $user->photo=$new_file;
        $user->address=$address;
        $user->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Update Success']);
    }
    public function add_user(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6'
        ]);
        $username=$request->username;
        $password=$request->password;
        $email=$request->email;
        $user =new User();
        $user->username=$username;
        $user->email=$email;
        $user->password=bcrypt($password);
        $user->permission='3';
        $user->permission_type='User';
        $user->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'User Added']);
    }
    public function user(){
        $users = DB::table('users')->paginate(10);
        return view('admin.users')->with('users',$users);
    }
    public function updatePermission(Request $request){
        $user=User::find($request->userid);
        $user->permission_type=$request->permission;
        $user->save();
        return $user=User::find($request->userid)->permission_type;
    }

    public function updateAction(Request $request){
        $action=$request->action;
        $id=$request->id;
        if($action==0){
            $action=1;
        }else if($action==1){
            $action=0;
        }
           $user=User::find($id);
           $user->action=$action;
           $user->save();
    }

    public function CategoresOfFoods(){
        $categories=Category::orderBy('id','DESC')->get();
        return view('admin.CategoresOfFoods')->with('categories',$categories);
    }

    public function getUpdateCategory($id){
        $updatecategory=Category::find($id);
        return view('admin.CategoresOfFoods')->with('updatecategory',$updatecategory);
    }

    public function postCategory(Request $request){
        $this->validate($request,[
            'category'=>'required',
            'description'=>'required'
        ]);
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            return redirect()->back()->withInput()->withErrors(['message'=>'Please Chose File']);
        }
        $imageString=rtrim($imageString,"||");
        $category=new Category();
        $category->name=$request->category;
        $category->image=$imageString;
        $category->description=$request->description;
        $category->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Category inserted to database']);
    }

    public function updateCategory(Request $request){
        $id=$request->id;
        $category=Category::find($id);
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }

         $imageString=rtrim($imageString,"||");
        }
        if($imageString==Null){
            $category->name=$request->category;
            $category->description=$request->description;
            $category->save();
        }else{
            $category->name=$request->category;
            $category->image=$imageString;
            $category->description=$request->description;
            $category->save();
        }
       
        return redirect()->back()->withInput()->withErrors(['message'=>'Update Complete']);
    }

    public function getDeleteCategory($id){
        $cate=Category::find($id);
        $cate->foods()->detach();
        $cate->delete();
        return redirect()->back()->withInput()->withErrors(['message'=>'Category Deleted']);

        
        

    }

    public function ajaxUpdateCat(Request $request){
        $id= $request->id;
        $Food_Type=Food_Type::find($id);
        $Food_Type->status='0';
        $Food_Type->save();
    }

    public function foods(){
        $foods=Food::orderBy('id','DESC')->paginate(5);
        return view('admin.foods')->with('foods',$foods);
    }
    public function postFood(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'category'=>'required',
        ]);
        $name=$request->name;
        $description=$request->description;
        $categorie=$request->category;
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            return redirect()->back()->withInput()->withErrors(['message'=>'Please Chose File']);
        }
       $imageString=rtrim($imageString,"||");
       $food=new Food();
       $food->title=$name;
       $food->images=$imageString;
       $food->description=$description;
       $food->user_id=Auth::user()->id;
       $food->save();
       foreach($categorie as $id){
           $cat=Category::find($id)->id;
           $food->categories()->attach($cat);
       }
       return redirect()->back()->withInput()->withErrors(['message'=>'Inserted Success!']);

         
    }



    public function Edit($id){
        $food=Food::find($id);
        return view('admin.editfood')->with('food',$food);
    }

    public function deleteFile($id,$key,$file){
        $imageString=Food::find($id)->files;
        $imageArray=explode("||",$imageString);
        File::delete('uploads/'.$imageArray[$key]);
        unset($imageArray[$key]);
        $newImageString=Null;
        foreach($imageArray as $images){
            $newImageString.=$images."||";
        }
        $newImageString=rtrim($newImageString,"||");
        $food=Food::find($id);
        $food->files=$newImageString;
        $food->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Delete file success!']);
    }

    public function postUpdateFood(Request $request){
        $name=$request->name;
        $description=$request->description;
        $categorie=$request->category;
        $multicat=Null;
        foreach($categorie as $category){
            $multicat.=$category.",";
        }
        $multicat=rtrim($multicat,",");
        $region=$request->region;
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            $imageString=Food::find($request->id)->files;
        }
       $imageString=rtrim($imageString,"||");
       $food=Food::find($request->id);
       $food->name=$name;
       $food->files=$imageString;
       $food->description=$description;
       $food->user_id=Auth::user()->id;
       $food->multicat=$multicat;
       $food->type_id=substr($multicat, 0,1);
       $food->save();
       return redirect()->route('getFoods')->withInput()->withErrors(['message'=>'Update Success!']);

    }

    public function getDeleteFood($id){
        $food=Food::find($id);
        $food->categories()->detach();
        $food->delete();
        return redirect()->back()->withInput()->withErrors(['message'=>'Delete Success!']);
    }

    public function getEditFood($id){
        $food=Food::find($id);
        return view('admin.foods')->with('food',$food);
    }
    public function getRegion(){
        $regions=DB::table('regions')->where('status','>','0')->paginate(10);
        return view('admin.regions')->with('regions',$regions);
    }

    public function getDeleteImageFood(Request $request){
        $food=Food::find($request->id);
        $imageString=$food->images;
        $imageArray=explode("||",$imageString);
        File::delete('uploads/'.$imageArray[$request->index]);
        unset($imageArray[$request->index]);
        $imageString=Null;
        foreach($imageArray as $image){
            $imageString.=$image."||";
        }
        $imageString=rtrim($imageString,"||");
        $food->images=$imageString;
        $food->save();


    }

    public function getUpdateFood(Request $request){
        $id=$request->id;
        $title=$request->name;
        $description=$request->description;
        $files=$request->file('files');
        $category=$request->category;
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            $imageString=Food::find($request->id)->images;
        }
       $imageString=rtrim($imageString,"||");

       $food=Food::find($id);
       $food->title=$title;
       $food->images=$imageString;
       $food->description=$description;
       $food->user_id=Auth::user()->id;
       $food->save();
       $food->categories()->detach();
       foreach($category as $id){
            $cat=Category::find($id)->id;
            $food->categories()->attach($cat);
       }
       return redirect()->back()->withInput()->withErrors(['message'=>'Update Success!']);

    }
    public function postRegion(Request $request){
        $this->validate($request,[
            'region'=>'required'
        ]);
        $region=$request->region;
        $description=$request->description;
        $tblRegion=new Region();
        $tblRegion->name=$region;
        $tblRegion->description=$description;
        $tblRegion ->save();
         return redirect()->back()->withInput()->withErrors(['message'=>'Insert Success']);
    }

    public function postUpdateRegion(Request $request){
        $id=$request->region_id;
        $name=$request->region;
        $description=$request->description;
        $region=Region::find($id);
        $region->name=$name;
        $region->description=$description;
        $region->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Update Success']);
    }

    public function deleteRegion(Request $request){
        $id=$request->id;
        $Region=Region::find($id);
        $Region->status='0';
        $Region->save();
    }

    public function getLocation(){
        $locations=DB::table('locations')->where('status','>','0')->paginate(10);
      return view('admin.locations')->with('locations',$locations);
    }

    public function postLocation(Request $request){
        $this->validate($request,[
            'address'=>'required'
        ]);
        $location =new Location();
        $location->name=$request->address;
        $location->description=$request->description;
        $location->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Insert Success!']);
    }

    public function postUpdateLocation(Request $request){
        $id=$request->id_location;
        $name=$request->address;
        $description=$request->description;
        $location=Location::find($id);
        $location->name=$name;
        $location->description=$description;
        $location->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Update Complete']);
    }

    public function deleteLocation(Request $request){
        $id= $request->id;
        $location=Location::find($id);
        $location->status='0';
        $location->save();
    }

    public function getStoreType(){
        $store__types=DB::table('store__types')->where('status','>','0')->paginate(10);
        return view('admin.storetypes')->with('store__types',$store__types);
    }

    public function getStore(){
        $all_stores=DB::table('stores')->where('status','>','0')->paginate(20);
        return view('admin.stores')->with('all_stores',$all_stores);
    }

    public function getEditStore($id){
        $editstore=Store::find($id);
        return view('admin.editstore')->with('editstore',$editstore);
    }
    public function deleteImageStore($key,$file,$id){
        $store=Store::find($id);
        $storeImage=Store::find($id)->images;
        $imageArray=explode("||", $storeImage);
        File::delete('uploads/'.$imageArray[$key]);
        unset($imageArray[$key]);
        $newImageString=Null;
        foreach($imageArray as $image){
            $newImageString.=$image."||";
        }
        $newImageString=rtrim($newImageString,"||");
        $store->images=$newImageString;
        $store->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'File has been deleted']);

    }
    public function postStore(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'open'=>'required',
            'close'=>'required',
            'description'=>'required',
            'address'=>'required'
        ]);
        $store=new Store();
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            $imageString=Food::find($request->id)->files;
        }
       $imageString=rtrim($imageString,"||");
       $store->name=$request->name;
       $store->phone=$request->phone;
       $store->website=$request->website;
       $store->images=$imageString;
       $store->address=$request->address;
       $store->description=$request->description;
       $store->map=$request->map;
       $store->open=$request->open;
       $store->close=$request->close;
       $store->location_id=$request->location;
       $store->user_id=Auth::user()->id;
       $store->store_type=$request->store_type;
       $store->save();
       return redirect()->back()->withInput()->withErrors(['message'=>'Insert Success!']);
    }

    public function postUpdateStore(Request $request){
        $files=$request->file('files');
        $store=Store::find($request->id);
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            $imageString=Store::find($request->id)->images;
        }
       $imageString=rtrim($imageString,"||");
       $store->name=$request->name;
       $store->phone=$request->phone;
       $store->website=$request->website;
       $store->images=$imageString;
       $store->address=$request->address;
       $store->description=$request->description;
       $store->map=$request->map;
       $store->open=$request->open;
       $store->close=$request->close;
       $store->location_id=$request->location;
       $store->store_type=$request->store_type;
       $store->save();
       return redirect()->route('getStore')->withInput()->withErrors(['message'=>'Update  Complete!']);

    }

    public function getDeleteStore($id){
        $store=Store::find($id);
        $store->status='0';
        $store->save();
         return redirect()->route('getStore')->withInput()->withErrors(['message'=>'Delete  Success!']);
    }

    public function postStoreType(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $name=$request->name;
        $storetype=new Store_Type();
        $storetype->name=$name;
        $storetype->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Insert Success!']);

    }


    public function postUpdateStoreType(Request $request){
        $type=Store_Type::find($request->id);
        $type->name=$request->name;
        $type->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Update Success!']);
    }

    public function deleteType(Request $request){
        $type=Store_Type::find($request->id);
        $type->status='0';
        $type->save();
    }


    public function getBookmark(){
        $bookmarks=DB::table('bookmarks')->where('status','>','0')->paginate(10);
        return view('admin.bookmarks')->with('bookmarks',$bookmarks);
    }

    public function getListFood(){
        
        $listAllFoods = DB::table('menus')
            ->join('stores', 'menus.store_id', '=', 'stores.id')
            ->join('users','users.id','=','stores.user_id')
            ->select('menus.*')->where('menus.status','>','0')
            ->paginate(15);
        return view('admin.listfoods')->with('listAllFoods',$listAllFoods);
    }

    public function postList(Request $request){
        $menu=new Menu();
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric'
        ]);
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            return redirect()->back()->withInput()->withErrors(['message'=>'Please Chose File']);
        }
       $imageString=rtrim($imageString,"||");
       $menu->name=$request->name;
       $menu->images=$imageString;
       $menu->price=$request->price;
       $menu->store_id=$request->store_id;
       $menu->description=$request->description;
       $menu->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'Insert Success']);
    }

    public function getEditList($id){
        $f=Menu::find($id);
        return view('admin.editList')->with('f',$f);
    }

    public function deleteImageList($key,$file,$id){
        $store=Menu::find($id);
        $storeImage=Menu::find($id)->images;
        $imageArray=explode("||", $storeImage);
        File::delete('uploads/'.$imageArray[$key]);
        unset($imageArray[$key]);
        $newImageString=Null;
        foreach($imageArray as $image){
            $newImageString.=$image."||";
        }
        $newImageString=rtrim($newImageString,"||");
        $store->images=$newImageString;
        $store->save();
        return redirect()->back()->withInput()->withErrors(['message'=>'File has been deleted']);
    }


    public function getUpdateList(Request $request){
        $menu=Menu::find($request->id);
        $files=$request->file('files');
        $imageString=Null;
        $randImage=md5(rand(1111,9999));
        $imageString=Null;
        if(!empty($files[0])){
             foreach ($files as $file) {
                    $file_name = $randImage.$file->getClientOriginalName();
                    $imageString.=$file_name."||";
                    $file->move('uploads', $file_name);
             }
        }else{
            $imageString=Menu::find($request->id)->images;
        }
        $imageString=rtrim($imageString,"||");
        $menu->name=$request->name;
        $menu->images=$imageString;
        $menu->price=$request->price;
        $menu->store_id=$request->store_id;
        $menu->description=$request->description;
        $menu->save();
        return redirect()->route('getListFood')->withInput()->withErrors(['message'=>'Update Success']);
    }

    public function deleteList($id){
        $menu=Menu::find($id);
        $menu->status="0";
        $menu->save();
        return redirect()->route('getListFood')->withInput()->withErrors(['message'=>'Delete Success']);
    }

    public function getPermission(Request $request){
        $userLavel=$request->lavel;
        $permission=Null;
        $userArray=explode(",",$userLavel);
        $lavel=$userArray[0];
        $userID=$userArray[1];
        $user=User::find($userID);
        if($lavel=="Administrator"){
            $permission=1;
        }else if($lavel=="Author"){
             $permission=2;
        }else{
             $permission=3;
        }
        $user->permission=$permission;
        $user->permission_type=$lavel;
        $user->save();
    }
 
   public function getTypeofFood(){
      $typeoffoods=Typeoffood::where('status','=','1')->get();
      return view('admin.typeoffood')->with('typeoffoods',$typeoffoods);
   }
   public function addtypeoffood(){
      return view('admin.addtyoffood');
   }
   
   public function postAddTypeofFood(Request $request){
      $name=$request->name;
      $description=$request->description;
      $this->validate($request,[
         'name'=>'required|min:3|unique:typeoffoods',
      ]);
      $Typeoffood=new Typeoffood();
      $Typeoffood->name=$name;
      $Typeoffood->description=$description;
      $Typeoffood->status=1;
      $Typeoffood->save();
      return redirect()->route('getTypeofFood')->with('message','Saved to database');
   }
   
   public function getViewTypeofFood($id){
      $Typeoffood=Typeoffood::find($id);
      return view('admin.viewtypeoffood')->with('Typeoffood',$Typeoffood);
   }
   
   public function postUpdateTypeofFood(Request $request){
      $id=$request->id;
      $name=$request->name;
      $description=$request->description;
      $Typeoffood=Typeoffood::find($id);
      $Typeoffood->name=$name;
      $Typeoffood->description=$description;
      $Typeoffood->save();
      return redirect()->route('getTypeofFood')->with('message','Updated to database');
   }
   
   public function getDeleteTypeofFood($id){
      $Typeoffood=Typeoffood::find($id);
      $Typeoffood->delete();
      $Typeoffood->typeoffoods()->sync($Typeoffood);
      return redirect()->route('getTypeofFood')->with('message','Deleted from database');
   }
   
   public function getTypeofPlace(){
          $Typeofplaces=Typeofplace::all();
      return view('admin.typeofplace')->with('Typeofplaces',$Typeofplaces);
   }
   
   public function addtypeofplace(){
      
      return view('admin.addtypeofplace');
   }
   
   public function postSaveTypeofPlace(Request $request){
      $this->validate($request,[
         'placename'=>'required|min:3|unique:typeofplaces'
      ]);
      $name=$request->placename;
      $description=$request->description;
      $Typeofplace=new Typeofplace();
      $Typeofplace->placename=$name;
      $Typeofplace->description=$description;
      $Typeofplace->save();
      return redirect()->route('getTypeofPlace')->with('message','Type of Place has been save');
      
   }
   
   public function getViewTypeofPlace($id){
      $Typeofplace=Typeofplace::find($id);
      return view('admin.viewtypeofplace')->with('Typeofplace',$Typeofplace);
   }
   
   public function postUpdateTypeofPlace(Request $request){
      $placename=$request->placename;
      $description=$request->description;
      $id=$request->id;
      $Typeofplace=Typeofplace::find($id);
      $Typeofplace->placename=$placename;
      $Typeofplace->description=$description;
      $Typeofplace->save();
      return redirect()->route('getTypeofPlace')->with('message','Type of Place has been update');
      
   }
   
   public function getDeleteTypeofPlace($id){
      $Typeofplace=Typeofplace::find($id);
      $Typeofplace->delete();
      return redirect()->route('getTypeofPlace')->with('message','Type of Place has been deleted');
   }

   public function getStoreRequest(){
    $storesRequests=Store::where('approval','0')->get();
    return view('admin.storerequest')->with('storesRequests',$storesRequests);
   }
  
  public function getApproval(Request $request ,$id){
    $store=Store::find($id);
    $store->approval=1;
    $store->save();
     return redirect()->route('getStoreRequest')->withInput()->withErrors(['status'=>'store has been approval']);
  }
  public function getRemoveGallery(){
    Gallery::truncate();
    return "Success";
 }

public function getRecommended(){
  $alls=Store::where('approval','1')->where('recommended','0')->where('status','1')->paginate(10);
  $recommend=Store::where('recommended','1')->paginate(10);
  return view('admin.storerecommend')->with('recommend',$recommend)->with('alls',$alls);
}

public function getCheckToActivate($id){
    $store=Store::find($id);
    return view('admin.checkativate')->withStore($store);
}

public function getDeleteStoreRequest($id){
    $store=Store::find($id);
    $store->delete();
    return redirect()->route('getStoreRequest');
}

public function getApprovallRestaurantRequest(){
   DB::statement("UPDATE stores SET approval =1 WHERE approval=0");
   return redirect()->back()->withInput()->withErrors(['status'=>'all restuarant has been appro']);
}

public function getRemoveRestaurantRequest(){
   DB::table('stores')->where('approval', '0')->delete();
   return redirect()->back()->withInput()->withErrors(['status'=>'all restuarant request has been delete']);
}
 
}
