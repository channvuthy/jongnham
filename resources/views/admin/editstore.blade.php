@section('content')
@extends('admin.master')
@section('title')
Edit Store 
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
         <li class="active">Edit Store</li>
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
   <div class="row">
      <form action="{{route('postUpdateStore')}}" method="post" enctype="multipart/form-data">
         <div class="col-sm-6">
            <div class="form-group">
               <label for="Name">Name</label>
               <small class="text-danger">{{$errors->first('name')}}</small>
               <input type="hidden" name="id" value="{{$editstore->id}}">
               <input type="text" name="name" id="" class="form-control" value="{{$editstore->name}}">
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Phone</label>
               <small class="text-danger">{{$errors->first('phone')}}</small>
               <input type="text" name="phone" id="" class="form-control" value="{{$editstore->phone}}">
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Website/Page</label>
               <small class="text-danger">{{$errors->first('website')}}</small>
               <input type="text" name="website" id="" class="form-control" placeholder="e.g http:://www.facebook.com/your_page" value="{{$editstore->website}}">
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Address</label>
               <small class="text-danger">{{$errors->first('address')}}</small>
               <input type="text" name="address" id="" class="form-control" value="{{$editstore->address}}">
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Map</label>
               <input type="text" name="map" id="" class="form-control" value="{{$editstore->map}}">
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Open</label>
               <small class="text-danger">{{$errors->first('open')}}</small>
               <input type="time" name="open" id="" class="form-control" value="{{$editstore->open}}">
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <small class="text-danger">{{$errors->first('close')}}</small>
               <label for="">Close</label>
               <input type="time" name="close" id="" class="form-control" value="{{$editstore->close}}">
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Location</label>
               <select name="location" id="" class="form-control">
               <?php
                  $locations=App\Models\Location::all();
                  ?>
               @if(count($locations))
               @foreach($locations as $location )
               <option value="{{$location->id}}" @if($editstore->location_id==$location->id) selected="selected" @endif>{{$location->name}}</option>
               @endforeach
               @endif
               </select>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Store Type</label>
               <select name="store_type" id="" class="form-control">
               <?php
                  $stores=App\Models\Store_Type::all();
                  ?>
               @if(count($stores))
               @foreach($stores as $store )
               <option value="{{$store->id}}" @if($editstore->store_type==$store->id)  selected="selected" @endif>{{$store->name}}</option>
               @endforeach
               @endif
               </select>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
               <label for="">Description</label>
               <textarea name="description" id="" cols="30" rows="10" class="my-editor">{{$editstore->description}}</textarea>
               @include('admin.textarea')
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
               @if(!empty($editstore->images))
               <?php
                  $imagesString=$editstore->images;
                  $imageArray=explode("||",$imagesString);
                  ?>
               @foreach($imageArray as $key => $singleArray)
               @if($key=='0')
               <div class="col-sm-3" style="padding-left:0px;margin-left:0px;">
                  <img src="{{asset('uploads')}}/{{$singleArray}}" alt="" style='max-width:100%;margin-bottom: 20px;min-height: 210px;'>
                  <a href="{{route('deleteImageStore',array($key,$singleArray,$editstore->id))}}" style="display:block;">Delete</a>
               </div>
               @else
               <div class="col-sm-3">
                  <img src="{{asset('uploads')}}/{{$singleArray}}" alt="" style='max-width:100%;min-height: 210px;margin-bottom: 20px;'>
                  <a href="{{route('deleteImageStore',array($key,$singleArray,$editstore->id))}}" style="display:block;">Delete</a>
               </div>
               @endif
               @endforeach
               <div class="clearfix" style="margin-bottom:20px;"></div>
               @else
               <label for="">Chose Files</label>
               <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]" multiple="multiple">
               @endif
            </div>
         </div>
         <div class="col-sm-12">
            <button type="submit" class="btn btn-info" style="border-radius:0px;">Update</button>
         </div>
         <div class="clearfix"></div>
   </div>
   </form>
</div>
</div>
@stop