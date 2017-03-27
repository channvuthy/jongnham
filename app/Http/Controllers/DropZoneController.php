<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\Models\Gallery;

class DropZoneController extends Controller
{
    
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('dropzone-view');
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        $imageName = time().$image->getClientOriginalName();
        Session::put('fileName',$imageName);
        $image->move(public_path('uploads'),$imageName);
        $gallery=new Gallery();
        $gallery->fileName=$imageName;
        $gallery->save();
        return response()->json(['success'=>$imageName]);
    }
}
