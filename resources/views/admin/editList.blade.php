@section('content')
@extends('admin.master')
@section('title')
Editi List 
@stop
@include('admin.header')
@include('admin.nav')
@if(Auth::user()->permission=='1')
@include('admin.sidebar')
@endif
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
   <div class="row">
      <ol class="breadcrumb">
         <li>
            <a href="{{route('dashboard')}}">
               <svg class="glyph stroked home">
                  <use xlink:href="#stroked-home"></use>
               </svg>
            </a>
         </li>
         <li class="active">Edit List </li>
      </ol>
   </div>
   <!--/.row-->
   <div class="row">
      <div class="col-sm-12">
         @if($errors->has('message'))
         <div class="alert alert-success">
            {{$errors->first('message')}}
         </div>
         @endif
      </div>
   </div>
   <form action="{{route('getUpdateList')}}" method="post" enctype="multipart/form-data">
      <br>
      <div class="col-sm-6">
         <div class="form-group">
            <label for="">Food Name</label>
            <small class="text-danger">{{$errors->first('name')}}</small>
            <input type="hidden" name="id" value="{{$f->id}}">
            <input type="text" name="name" id="" class="form-control" value="{{$f->name}}">
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <label for="">Price</label>
            <small class="text-danger">{{$errors->first('price')}}</small>
            <input type="text" name="price" id="" class="form-control" value="{{$f->price}}">
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <label for="">Store Name</label>
            <select name="store_id" id="" class="form-control">
            <?php
               $stores=DB::table('stores')->where('user_id','=',Auth::user()->id)->get();
               ?>
            @foreach($stores as $store)
            <option value="{{$store->id}}" @if($f->store_id==$store->id)  selected="selected" @endif>{{$store->name}}</option>
            @endforeach
            </select>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="form-group">
            <label for="">Description</label>
            <small class="text-danger">{{$errors->first('description')}}</small>
            <textarea name="description" id="" cols="30" rows="10">{{$f->description}}</textarea>
         </div>
      </div>
      <div class="col-sm-12">
         @if(!empty($f->images))
         <?php
            $imagesString=$f->images;
            $imageArray=explode("||",$imagesString);
            ?>
         @foreach($imageArray as $key => $singleArray)
         @if($key=='0')
         <div class="col-sm-3" style="padding-left:0px;margin-left:0px;">
            <img src="{{asset('uploads')}}/{{$singleArray}}" alt="" style='max-width:100%;margin-bottom: 20px;min-height: 210px;'>
            <a href="{{route('deleteImageList',array($key,$singleArray,$f->id))}}" style="display:block;">Delete</a>
         </div>
         @else
         <div class="col-sm-3">
            <img src="{{asset('uploads')}}/{{$singleArray}}" alt="" style='max-width:100%;min-height: 210px;margin-bottom: 20px;'>
            <a href="{{route('deleteImageList',array($key,$singleArray,$f->id))}}" style="display:block;">Delete</a>
         </div>
         @endif
         @endforeach
         <div class="clearfix" style="margin-bottom:20px;"></div>
         @else
         <div class="form-group">
            <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]" multiple="multiple">
         </div>
         @endif
      </div>
      <div class="col-sm-12">
         <button type="submit" class="btn btn-info" style='border-radius:0px;'>Update</button>
      </div>
</div>
</form>
</div>
@stop