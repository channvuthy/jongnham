@section('content')
@extends('admin.master')
@section('title')
Change Background Image
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
         <li class="active">Change Background Image</li>
      </ol>
   </div>
   <!--/.row-->
   <div class="row">
      <div class="col-md-12">
         <form action="{{route('postChangeBackgroundImage')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="">Change Background</label>
               <input type="file" name="file" id="" class="form-control">
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <input type="hidden" name="key" value="{{$key}}">
               <input type="hidden" name="name" value="{{$name}}">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary">Change File</button>
            </div>
         </form>
      </div>
   </div>
@stop