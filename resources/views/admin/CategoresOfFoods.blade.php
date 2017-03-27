@section('content')
@extends('admin.master')
@section('title')
Category Foods
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
      <li class="active">Types Of Foods</li>
   </ol>
</div>
<!--/.row-->
<div class="row">
   <div class="col-sm-12">
      @if($errors->has('message'))
      <br>
      <div class="alert alert-success">
         {{$errors->first('message')}}
      </div>
      @endif
   </div>
</div>
@if(isset($updatecategory->id))
<br>
<div class="col-sm-6">
   <form action="{{route('postUpdateCategory')}}" method="post" enctype="multipart/form-data">
      <div class="form-group">
         <label for="">Category Name</label>
         <input type="hidden" name="id" id="" class="form-control" value="{{$updatecategory->id}}">
         <input type="text" name="category" id="" class="form-control" value="{{$updatecategory->name}}">
         <small class="text-danger">{{$errors->first('category')}}</small>
      </div>
      <div class="form-group">
         <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]">
      </div>
      <div class="form-group">
         <label for="">Description</label>
         <textarea name="description" id=""  rows="5" class="form-control my-editor">{{$updatecategory->description}}</textarea>
         @include("admin.textarea")
         <input type="hidden" name="_token" value="{{Session::token()}}">
         <small class="text-danger">{{$errors->first('description')}}</small>
      </div>
      <div class="form-group">
         <button class="btn btn-info" type="submit" style="border-radius:0px;">Update</button>
         <a href="{{route('CategoresOfFoods')}}" class="btn btn-default">Go Back</a>
      </div>
   </form>
</div>
<div class="col-md-6">
   <div class="form-group">
      <label for="">Image Category</label>
      <div class="thumbnail">
         <img src="{{URL::to('/')}}/uploads/{{$updatecategory->image}}" alt="" class="img-responsive">
      </div>
      </div
   </div>
   @else
   <div class="row">
      <div class="col-sm-6">
         <br>
         <table class="table">
            <thead>
               <tr>
                  <td>ID</td>
                  <td>Name</td>
                  <td>Description</td>
                  <td>Action</td>
               </tr>
            </thead>
            <tbody>
               @foreach($categories as $category)
               <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td><?php $description=strip_tags($category->description);?>
                     <?php $sortText=substr($description, 0,100);?>
                     <?php echo $sortText."...";?>
                  </td>
                  <td><a href="{{route('getupdatecategory',['id'=>$category])}}"><span class="fa fa-edit"></span></a> | <a href="{{route('getdeletecategory',['id'=>$category])}}"><span class="fa fa-trash" onclick="return confirm('Are you sure to delete this item?')"></span></a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="col-sm-6">
         <p><br></p>
         <form action="{{route('postCategory')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="">Category Name</label>
               <input type="text" name="category" id="" class="form-control">
               <small class="text-danger">{{$errors->first('category')}}</small>
            </div>
            <div class="form-group">
               <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]">
            </div>
            <div class="form-group">
               <label for="">Description</label>
               <textarea name="description" id=""  rows="5" class="form-control  my-editor"></textarea>
               @include("admin.textarea")
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <small class="text-danger">{{$errors->first('description')}}</small>
            </div>
            <div class="form-group">
               <button class="btn btn-info" type="submit" style="border-radius:0px;">Save</button>
            </div>
         </form>
      </div>
   </div>
   @endif
</div>
@stop