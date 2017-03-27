<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Slider;
class SliderController extends Controller
{
	public function getSlider(){
		$sliders=Slider::orderBy('id','DESC')->paginate(10);
		return view('admin.slider')->with('sliders',$sliders);
	}
	
	public function postSlider(Request $request){
		$this->validate($request,[
			'title'=>'required',
			'description'=>'required'
		]);
		$slider=new Slider();
		$slider->title=$request->title;
		$slider->description=$request->description;
		$slider->save();
		$sliders=Slider::orderBy('id','DESC')->paginate(10);
		return view('admin.slider')->with('sliders',$sliders)->with('message','Insert Successfully!!!');
		
	}
	public function getEditSlider($id){
		$singleslider=Slider::find($id);
		$sliders=Slider::orderBy('id','DESC')->paginate(10);
		return view('admin.slider')->with('sliders',$sliders)->with('singleslider',$singleslider);
		
	}
	
	public function postUpdateSlider(Request $request){
		$id=$request->id;
		$description=$request->description;
		$title=$request->title;
		$slider=Slider::find($id);
		$slider->title=$title;
		$slider->description=$description;
		$slider->save();
		return redirect()->route('getslider');
	}
	
	public function getDeleteSilder($id){
		$slider=Slider::find($id);
		$slider->delete();
		session()->flash('message','Delete Successfully!!!!!!!');
		return redirect()->route('getslider');
	}
}