@section('content')
@extends('admin.master')
@section('title')
    About Us
@stop
@include('admin.header')
@include('admin.nav')
    @if(Auth::user()->permission=='1')
        @include('admin.sidebar')
    @endif

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">About Us</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
        	<form method="post" entype="multipart/form-data" action="{{isset($singleAbout->id)?route('postUpdateAbout'):route('postAbout')}}"
	        	<div class="col-md-12">
	        		<div class="form-group">
	        			<label>About Us</label>
	        			<textarea name="description" class="form-control my-editor">{{isset($singleAbout->id)?$singleAbout->description:''}}</textarea>
	        			
	        			<input type="hidden" value="{{Session::token()}}" name="_token">
	        			<input type="hidden" name="id" value="{{isset($singleAbout)?$singleAbout->id:''}}"
	        			@include('admin.textarea')
	        		</div>
	        		<div class="form-group">
	        			<button type="submit" class="btn btn-primary">Save</button>
	        		</div>
	        	</div>
        	</form>
        	<div class="row">
        		<div class="form-group">
        			<table class="table">
        				<thead>
        					<tr>
        						<th>ID</th>
        						<th>Description</th>
        						<th>Created at</th>
        						<th>Update at</th>
        						<th>Action</th>
        					</tr>
        				</thead>
        				@if(isset($about->id))
        					<tr>
        						<td>{{$about->id}}</td>
        						<td>{!!mb_substr($about->description, 0, 150, "UTF-8")!!}...</td>
        						<td>{{$about->created_at}}</td>
        						<td>{{$about->updated_at}}</td>
        						<td><a href="{{route('getEditAbout',array($about->id))}}">Edit</a>| <a href="{{route('getDeleteAbout',array($about->id))}}">Delete</a></td>
        					</tr>
        				@endif
        			<table>
        		</div>
        	</div>
        </div>
        
  @stop