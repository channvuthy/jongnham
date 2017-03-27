<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Store;
use App\Models\User;
use DB;
use Auth;
use App\Models\Comment;
use App\Models\User_Review;
class ReviewController extends Controller
{
    public function getReview(Request $request){
        $storeID  =  $request->storeID;
    	$userID   =  $request->userID;
    	$store=Store::find($storeID);
    	$exists = $store->userReview->contains($userID);
    	if($exists ==false){
    		$store->save();
    		$store->userReview()->attach($userID);
    	}
    	return redirect()->back()->withInput()->withErrors(['status'=>'Review Successfully!']);
    }

    public function getListReview(){
    	return view('version2.listreview');
    }
    public function getPreviewStore(Request $request){
    	$userID=$request->userID;
    	$storeID=$request->id;
    	$store=Store::find($storeID);
    	$exists = $store->userReview->contains($userID);
    	if($exists ==false){
    		$store->save();
    		$store->userReview()->attach($userID);
    	} 

    	$existComment= $stores=DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeID}");
    	return view('version2.reviewpreview')->with('store',$store)->with('comment',$existComment);
    }

    public function getComment(Request $request){
    	$userID=$request->userID;
    	$storeID=$request->storeID;
    	$store=Store::find($storeID);
    	$exists = $store->userReview->contains($userID);
    	if($exists ==false){
    		return redirect()->back();
    	} 

   		$comment=$request->comment;
   		$existComment= $stores=DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeID}");
   		if(count($existComment)>0){
   			return redirect()->back();
   		}
   		$usercomment=new Comment;
   		$usercomment->user_id=$userID;
   		$usercomment->store_id=$storeID;
   		$usercomment->comment_body=$comment;
   		$usercomment->save();
   		return redirect()->back();

    }

    public function postUpdateComment(Request $request){
    	$userID=$request->userID;
    	$storeID=$request->storeID;
    	$comment=$request->comment;
    	$existComment= $stores=DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeID}");
   		if(count($existComment)>0){
   			$c=Comment::where('store_id',$storeID)->first();
   			$c->comment_body=$comment;
   			$c->save();
   			return redirect()->back();
   		}
   		return redirect()->back();
    }

    public function poseSearchUpdateComment(Request $request){
    	$userID=$request->userID;
    	$storeID=$request->storeID;
    	$comment=$request->comment;
    	$existComment= DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeID}");
      if($existComment!=0){
        DB::table('comments')->where('user_id', $userID)->where('store_id',$storeID)->update(array('comment_body' => $comment));
      }
   		
   		
    }

    public function getStoreSearchComment(Request $request){
    	$userID=$request->userID;
    	$storeID=$request->storeID;
    	$comment=$request->comment;
    	$existComment= $stores=DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeID}");
   		if(count($existComment)<=0){
   			$c=new Comment();
   			$c->user_id=$userID;
   			$c->store_id=$storeID;
   			$c->comment_body=$comment;
   			$c->save();
        $existComment= DB::select("SELECT * FROM user__reviews WHERE store_id={$storeID} AND user_id ={$userID}");
        if(count($existComment)==0){
          $reviewuser=new User_Review();
          $reviewuser->store_id=$storeID;
          $reviewuser->user_id=$userID;
          $reviewuser->save();
        }
   			return "Comment Success";
   		}
   		return "Update Fail!";
    }


    public function getUserReview(Request $request){
        $userID=$request->userID;
        $storID=$request->storID;
        $comment=$request->comment;
        $c=Comment::where('user_id','=', $userID)->where('store_id','=',$storID)->count();
        if($c!=1){
          $com= new Comment();
          $com->user_id=$userID;
          $com->store_id=$storID;
          $com->comment_body=$comment;
          $com->save();
          return "Comment Saved";
        }

    }
}
