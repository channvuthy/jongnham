@section('content')
@extends('admin.master')
@section('title')
    CSV File
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
      <li class="active">Upload Restuarant</li>
   </ol>
</div>
<!--/.row-->
<br>
<div class="row">
   <div class="col-sm-12">
      @if($errors->has('message'))
      <div class="alert alert-success">
         {{$errors->first('message')}}
      </div>
      @endif
   </div>
   <form action="{{route('upload.csv')}}" method="post" enctype="multipart/form-data">
      <div class="col-md-12">
         <div class="form-group">
           <label for="">CSV File</label>
            <input type="file" name="file" id="" class="form-control">
            <span class="text-danger">{{$errors->first('status')}}</span>
            <span class="text-danger">{{$errors->first('file')}}</span>
            <input type="hidden" name="_token" value="{{Session::token()}}">
         </div>
             <button type="submit" class="btn btn-primary">Upload</button>
      </div>
   </form>
   <br>
   <hr>
   <div class="row">
      <div class="col-sm-12">
      </div>
   </div>
</div>
@stop