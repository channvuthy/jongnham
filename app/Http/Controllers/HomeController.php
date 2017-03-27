<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use DB;
use App\Models\Food_Type;
use App\Food;
use App\Category;
use Request;
use App\Backgroundimage;
use App\Background;
use App\Slider;
use App\About;
class HomeController extends Controller
{
    public function Category($name,$id){
        $the_list_post_in_category=$this->get_the_post_in_category();
        $get_the_title_category=$this->get_the_title_category();
        $backgroundimage=Backgroundimage::get()->first()->allbackground;
        $background=Background::get()->first();
        return view('category')->with('the_list_post_in_category',$the_list_post_in_category)->with('get_the_title_category',$get_the_title_category)->with('backgroundimage',$backgroundimage)->with('background',$background);
    }

    public function getCategory(){
        $backgroundimage=Backgroundimage::get()->first()->allbackground;
        $sliders=Slider::get();
        $background=Background::get()->first();
        $categories=Category::get();
        return view('categories')->with('categories',$categories)->with('backgroundimage',$backgroundimage)->with('background',$background)->with('sliders',$sliders)->with('sliders',$sliders);;
    }

    public function food_description($name,$title,$id){
       $backgroundimage=Backgroundimage::get()->first()->allbackground;
        $background=Background::get()->first();
        $detail=Food::find($id);
        $newFoods=Food::orderBy('id','DESC')->paginate(6);
        $the_category=$this->get_the_post_in_category();
        return view('food_details')->with('detail',$detail)->with('newFoods',$newFoods)->with('the_category',$the_category)->with('backgroundimage',$backgroundimage)->with('background',$background);    
    }

    public function getHome(){

         $foods=\App\Food::orderBy('id','DESC')->paginate(6);
         $sliders=Slider::get();
        $backgroundimage=Backgroundimage::get()->first()->allbackground;
        $background=Background::get()->first();
        $categories=\App\Category::orderBy('user_click','DESC')->orderBy('user_click','DESC')->paginate(3);
        $about=About::get()->first();
        return view('index')->with('foods',$foods)->with('categories',$categories)->with('backgroundimage',$backgroundimage)->with('background',$background)->with('background',$background)->with('sliders',$sliders)->with('about',$about);
        //return view('version2.index');
    }

    public function autocomplete(Request $request){
        $search=$_GET['term'];
        $results=array();
        $queries = Food::where('title', 'LIKE', '%'.$search.'%')->get();
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' =>$query->title,'avatar' => $query->images];
        }
        return ($results);
    
    }

    public function get_the_post_in_category(){
        $backgroundimage=Backgroundimage::get()->first()->allbackground;
        $background=Background::get()->first();
        return Food::whereHas('categories',function($q){
            $q->where('name',str_replace('-',' ',Request::segment(1)));
        })->get();
    }
    public function get_the_title_category(){
        return str_replace('-', ' ',Request::segment(1));
    }
 }
