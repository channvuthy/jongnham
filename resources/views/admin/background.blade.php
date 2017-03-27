@section('content')
@extends('admin.master')
@section('title')
Background
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
         <li class="active">Background</li>
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
      <form action="{{route('postBackgroundNormal')}}" entype="multipart/form-data" method="post">
         <input type="hidden" name="_token" value="{{Session::token()}}"/>
         <div class="col-md-12">
            <div class="form-group">
               <h3>Background Normal</h3>
            </div>
            <div class="form-group">
               <label for="">Background Header</label>
               <input class="jscolor form-control"  name="bg_header" value="{{isset($backgroundnormal->id)?$backgroundnormal->header:''}}">
            </div>
            <div class="form-group">
               <label for="">Background Body</label>
               <input class="jscolor form-control"  name="bg_body" value="{{isset($backgroundnormal->id)?$backgroundnormal->body:''}}">
            </div>
            <div class="form-group">
               <label for="">Background Latest Post </label>
               <input class="jscolor form-control"  name="bg_block_food" value="{{isset($backgroundnormal->id)?$backgroundnormal->foodblock:''}}">
            </div>
            <div class="form-group">
               <label for="">Home Popular Category</label>
               <input class="jscolor form-control"  name="bg_block_category" value="{{isset($backgroundnormal->id)?$backgroundnormal->blockcategory:''}}">
            </div>
            <div class="form-group">
               <label for="">Background Category</label>
               <input class="jscolor form-control"  name="bg_category" value="{{isset($backgroundnormal->id)?$backgroundnormal->bg_category:''}}">
            </div>
            <div class="form-group">
               <label for="">Background Sub Category</label>
               <input class="jscolor form-control"  name="bg_sub" value="{{isset($backgroundnormal->id)?$backgroundnormal->bg_sub:''}}">
            </div>
            <div class="form-group">
               <label for="">Background Footer</label>
               <input class="jscolor form-control"  name="bg_footer" value="{{isset($backgroundnormal->id)?$backgroundnormal->footer:''}}">
            </div>
            <div class="fom-group">
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
      </form>
      <form action="{{route('postBackgroundImage')}}" enctype="multipart/form-data" method="post">
         <input type="hidden" name="_token" value="{{Session::token()}}"/>
         <div class="col-md-12">
            <div class="form-group">
               <h3>Background Image</h3>
               <input type="hidden" value="{{Session::token()}}" name="_token()"/>
            </div>
            <div class="form-group">
               <input type="file" name="allfile[]" id="" class="form-control" maxlength="5" multiple="multiple">
               <br>
               <a href="{{route('viewbackgroundimage')}}">View Background</a>
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
      </form>
   </div>
</div>
@stop