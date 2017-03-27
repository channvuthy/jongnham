@section('content')
@extends('admin.master')
@section('title')
Users
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
         <li class="active">Foods</li>
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
   <form action="{{route('postUpdateFood')}}" method="post" enctype="multipart/form-data">
      <div class="row">
         <br>
         <input type="hidden" name="_token" value="{{Session::token()}}">
         <div class="col-sm-6">
            <div class="form-group">
               <input type="hidden" name="id" value="{{$food->id}}">
               <label for="">Food Name</label>
               <div class="form-group {{($errors->has('name'))?'has-error':''}}">
                  <input type="text" name="name" id="" class="form-control" placeholder="{{$errors->first('name')}}"  value="{{$food->name}}">
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               <label for="">Region</label>   
               <select name="region" id="" class="form-control">
               <?php
                  $regions =App\Models\Region::all();
                  ?>
               @foreach($regions as $region)
               <option value="{{$region->id}}" @if($food->region_id==$region->id) selected="selected" @endif>{{$region->name}}</option>
               @endforeach
               </select>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group {{($errors->has('name'))?'has-error':''}}">
               <label for="">Description</label>
               <textarea name="description" id="foodsdescription">{{$food->description}}</textarea>
            </div>
         </div>
         <div class="col-sm-6">
            <label for="">Category Of  Foods</label>
            <div class="form-group">
               <?php
                  $categories=App\Models\Food_Type::where('status','>','0')->get();
                  ?>
               <?php $categoryArray=explode(",", $food->multicat);?>
               @foreach($categories as $category)
               <input type="checkbox" name="category[]" id="" value="{{$category->id}}" @if(in_array($category->id, $categoryArray)) checked="checked" @endif;>  {{$category->name}}
               @endforeach
            </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
               @if(!empty($food->files))
               <?php
                  $imageString=$food->files;
                  $imageArray=explode("||",$imageString);
                  ?>
               @foreach($imageArray as $key =>$image)
               <?php
                  $imageArray=explode(".", $image);
                  $type=end($imageArray);
                  ?>
               @if($type !='mp4')
               <img src="{{asset('uploads')}}/{{$image}}" alt="" class="thumbnail" style="max-width:100%;">
               <a href="{{route('deleteFile',array($food->id,$key,$image))}}">Delete</a>
               <br><br>
               @else
               <video src="{{asset('uploads')}}/{{$image}}" controls="" style="max-width:100%;" ></video>
               <br>
               <br>
               <a href="{{route('deleteFile',array($food->id,$key,$image))}}">Delete</a>
               <br><br>
               @endif
               @endforeach
               @else
               <label for="">Chose Files</label>
               <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]" multiple="multiple">
               @endif
            </div>
         </div>
      </div>
      <div class="row">
         <br>
         <br>
         <div class="col-sm-12">
            <div class="form-group text-right">
               <button type="submit" class="btn btn-info" style='border-radius:0px;'>Update</button>
            </div>
         </div>
      </div>
   </form>
</div>
@stop