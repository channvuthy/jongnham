<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Gallery;
use App\Models\Store;
use File;

class GalleryController extends Controller
{
    public function getGallery(){
    	$galleries=Gallery::all();
    	return $galleries;
    }

    public function getDeleteImage(Request $request){
    	$lastFile=null;
    	$storeID=$request->id;
    	$key=$request->key;
    	$image=$request->dataimage;
    	$store=Store::find($storeID);
    	$originalFile=$store->images;
    	$arrayFile=explode("||", $originalFile);
    	unset($arrayFile[$key]);
    	foreach($arrayFile as $remainFile){
    		$lastFile.=$remainFile."||";
    	}
    	$lastFile=rtrim($lastFile,"||");
    	$store->images=$lastFile;
    	$store->save();
    	File::delete('uploads/'.$image);
    	
    }
}
