@section('content')
@extends('admin.master')
@section('title')
Slider
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
      <li class="active">Slider</li>
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
</div>
<form action="{{(isset($singleslider->id)?route('postUpdateSlider'):route('postSlider'))}}" enctype="multipart/form-data" method="post" novalidate>
   <div class="form-group">
      <label for="">Slider Title</label>
      <input type="hidden" name="_token" value={{Session::token()}}>
      <input type="hidden" name="id" value="{{(isset($singleslider->id)?$singleslider->id:'')}}"/>
      <input type="text" name="title" id="" class="form-control" required value="{{(isset($singleslider->id)?$singleslider->title:'')}}">
   </div>
   <div class="form-group">
      <label for="">Description</label>
      <textarea name="description" class="form-control my-editor" required>{{(isset($singleslider->id)?$singleslider->description:'')}}</textarea>
      @include('admin.textarea')
   </div>
   <div class="form-group">
      <button type="submit" class="btn btn-primary">{{(isset($singleslider->id)?'Update Slider':'Save Slider')}}</button>
   </div>
</form>
<div class="row">
   <div class="col-md-12 col-sm-12">
      <table class="table">
         <caption>Slider</caption>
         <thead>
            <tr>
               <th>ID</th>
               <th>Title</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach($sliders as $slider)
            <tr>
               <td>{{$slider->id}}</td>
               <td>{{$slider->title}}</td>
               <td><a href="{{route('getEditSlider',array('id'=>$slider->id))}}">Edit</a> | <a href="{{route('getDeleteSilder',array('id'=>$slider->id))}}" onclick="return comfirm('Are you sure delete this item?')">Delete</a></td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@stop