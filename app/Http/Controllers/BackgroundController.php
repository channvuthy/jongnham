<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Background;
use File;
use App\Backgroundimage;
class BackgroundController extends Controller
{
    public function getBackground()
    {
        $backgroundnormal = Background::first();
        return view('admin.background')->with('backgroundnormal', $backgroundnormal);
    }

    public function postBackgroundNormal(Request $request)
    {
        $bg_header         = $request->bg_header;
        $background        = null;
        $bg_body           = $request->bg_body;
        $bg_block_food     = $request->bg_block_food;
        $bg_footer         = $request->bg_footer;
        $bg_block_category = $request->bg_block_category;
        $bg_category       = $request->bg_category;
        $bg_sub            = $request->bg_sub;
        $result            = Background::get();
        if ($result->first()) {
            $id                        = $result->first()->id;
            $background                = Background::find($id);
            $background->header        = $bg_header;
            $background->body          = $bg_body;
            $background->foodblock     = $bg_block_food;
            $background->blockcategory = $bg_block_category;
            $background->bg_category   =$bg_category;
            $background->bg_sub        =$bg_sub;
            $background->footer        = $bg_footer;
            $background->save();
            $backgroundnormal = Background::first();
            return redirect()->route('getBackground')->with('backgroundnormal', $backgroundnormal);

        } else {

            $background                = new Background();
            $background->header        = $bg_header;
            $background->body          = $bg_body;
            $background->foodblock     = $bg_block_food;
            $background->blockcategory = $bg_block_category;
            $background->bg_category   =$bg_category;
            $background->bg_sub        =$bg_sub;
            $background->footer        = $bg_footer;
            $background->save();
            return redirect()->route('getBackground')->with('backgroundnormal', $backgroundnormal);

        }
    }

    public function postBackgroundImage(Request $request)
    {
        $imageString     = Null;
        $files           = $request->file('allfile');
        $imageString     = Null;
        $backgroundImage = Backgroundimage::get();
        if ($backgroundImage->first()) {
            if (!empty($files[0])) {
                foreach ($files as $file) {
                    $randImage = md5(rand(1111, 9999));
                    $file_name = $randImage . $file->getClientOriginalName();
                    $imageString .= $file_name . "||";
                    $file->move('uploads', $file_name);
                }
            }
            $id                         = $backgroundImage->first()->id;
            $singleImage                = Backgroundimage::find($id);
            $imageString                = rtrim($imageString, "||");
            $singleImage->allbackground = $imageString;
            $singleImage->save();
            return redirect()->route('viewbackgroundimage');
        } else {
            if (!empty($files[0])) {
                foreach ($files as $file) {
                    $randImage = md5(rand(1111, 9999));
                    $file_name = $randImage . $file->getClientOriginalName();
                    $imageString .= $file_name . "||";
                    $file->move('uploads', $file_name);
                }
            }
            $backgroundImage                = new Backgroundimage();
            $imageString                    = rtrim($imageString, "||");
            $backgroundImage->allbackground = $imageString;
            $backgroundImage->save();
            return redirect()->route('viewbackgroundimage');
        }

    }
    public function getViewBackgroundImage()
    {
        $backgroundimage = Backgroundimage::get()->first();
        return view('admin.viewbackgroundimage')->with('backgroundimage', $backgroundimage);
    }

    public function getDeleteBackgroundImage(Request $request, $key, $name)
    {
        $backgroundimage=Backgroundimage::get()->first();
        return view('admin.changebackgroundimage')->with('key',$key)->with('name',$name)->with('backgroundimage',$backgroundimage);
    }
    public function postChangeBackgroundImage(Request $request){
        $key=$request->key;
        $randImage = md5(rand(1111, 9999));
        $name=$request->name;
        $backgroundimage = Backgroundimage::get()->first();
        $imageString=$backgroundimage->allbackground;
        $updateBackgroundImage=Backgroundimage::find($backgroundimage->id);
        $imageArray=explode("||",$imageString);
        $temp=$imageArray;
        $file=$request->file('file');
        $fileName=$file->getClientOriginalName();
        $file->move('uploads', $fileName);
        unset($imageArray[$key]);
        file::delete('uploads/'.$name);
        $imageArray[$key]=$fileName;
        ksort($imageArray);
        $image=Null;
        foreach($imageArray as $string){
         $image.=$string."||";
        }
        $image=rtrim($image,"");
        $updateBackgroundImage->allbackground=$image;
        $updateBackgroundImage->save();
        return redirect()->route('viewbackgroundimage');



    }
}