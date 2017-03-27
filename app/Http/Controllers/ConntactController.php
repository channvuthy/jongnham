<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
class ConntactController extends Controller
{
   public function postContact(Request $request){
   	$this->validate($request,[
   		'name'=>'required|min:3',
   		'email'=>'required|email',
   		'message'=>'required'
   	]);
   	$name=$request->name;
   	$email=$request->email;
   	$message=$request->message;
   	return $request->all();
   }
}
