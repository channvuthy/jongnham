<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Http\Requests;

class AboutController extends Controller
{
    public function getAbout(){
       $about=About::get()->first();
    	return view('admin.about')->with('about',$about);
    }
    public function postAbout(Request $request){
    	$checkAbout=About::get()->first();
    	if($checkAbout->id >='1'){
    	$description =$request->description;
    	$about=About::find($checkAbout->id);
    	$about->description=$description;
    	$about->save();
    	return redirect()->route('getAbout')->withInput()->withErrors(['message'=>'Upudate Successfully!!!!!!']);
    	}else{
    	$description =$request->description;
    	$about=new About();
    	$about->description=$description;
    	$about->save();
    	return redirect()->route('getAbout')->withInput()->withErrors(['message'=>'Insert Successfully!!!!!!!']);
    	
    	}
    }
    
    public function getEditAbout($id){
    	$about=About::get()->first();
    	$singleAbout=About::find($id)->first();
    	return view('admin.about')->with('about',$about)->with('singleAbout',$singleAbout);
    }
    
    public function getDeleteAbout($id){
    	$about=About::find($id);
    	$about->delete();
    	return redirect()->route('getAbout');
    }
    
    public function postUpdateAbout(Request $request){
    	$about=About::find($request->id);
    	$about->description=$request->description;
    	$about->save();
    	return redirect()->route('getAbout')->withInput()->withErrors(['message'=>'Update Successfully!!!!!!']);
    }
}
