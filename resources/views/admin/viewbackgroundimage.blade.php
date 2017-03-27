@section('content')
@extends('admin.master')
@section('title')
Background Image
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
         <li class="active">Background Image</li>
      </ol>
   </div>
   <!--/.row-->
   <br>
   <div class="row">
      <div class="col-md-3">
      <?php $bg=$backgroundimage->allbackground;?>
      <?php $imageArray=explode("||",$bg);?>
      @foreach($imageArray as $key =>$value)
         @if($key=="0")
         <h4>Background Header</h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @elseif($key=="1")
         <h4>Background Body</h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @elseif($key=="2")
         <h4> Background Latest Post </h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @elseif($key=="3")
         <h4>Home Popular Category</h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @elseif($key=="4")
         <h4>Background Category</h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @elseif($key=="5")
         <h4>Background Footer</h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @elseif($key=="6")
         <h4>Background Sub Category</h4>
         <img src="{{URL("/")}}/uploads/{{$value}}" alt="" class="img-responsive">
         <br>
         <a href="{{route('getDeleteBackgroundImage',array($key,($value)?$value:'nobackground'))}}">Change Background</a>
         @endif
      @endforeach
      </div>
   </div>
   @stop