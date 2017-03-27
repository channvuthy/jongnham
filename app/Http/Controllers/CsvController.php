<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;
use DB;
use App\Test;
use App\Models\Store;
use App\Models\user_stores;
use Auth;

class CsvController extends Controller
{
    public function getCsv(){
    	 return view('admin.csv');
    }

    public function postCsv(Request $request){
    	$this->validate($request,[
    	 	'file'=>'required'
    	]);
    	$file=$request->file('file');
    	 $fileName=$file->getClientOriginalName();
    	 $fileExtention=explode(".", $fileName);
    	 $fileExtention=end($fileExtention);
    	 if($fileExtention!="csv"){
    	 	return redirect()->back()->withInput()->withErrors(['status'=>'File extention not valid (csv file)']);
    	 }

    	 Excel::load($request->file('file'),function($reader){
    	 	$reader->each(function($sheet){
    	 		Store::firstOrCreate($sheet->toArray());
    	 	});
    	 });
    	$date=date('m/d/Y');
 	$len=strlen($date);
	$n=substr($date,0,1);
	if($n=="0"){
		$n=substr($date,1);
	}
    	 $stores=Store::where('import_date',$date)->orWhere('import_date',$n)->get();
    	 
    	 foreach($stores as $store){
    	 $users=new user_stores();
    	 $users->user_id=Auth::user()->id;
    	 $users->store_id=$store->id;
    	 $users->save();
    	 }
    	 return redirect()->back()->withInput()->withErrors(['status'=>'Import Success']);
    }

    public function getExport(){
    	$export=Store::all();
    	Excel::create('Export Custome',function($excel) use ($export){
    		$excel->sheet('Sheet1',function($sheet) use ($export){
    			$sheet->fromArray($export);
    		});
    	})->export('xlsx');
	
    }
}
