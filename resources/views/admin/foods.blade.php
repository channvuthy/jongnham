@section('content')
@extends('admin.master')
@section('title')
Foods
@stop
@include('admin.header')
@include('admin.nav')
@if(Auth::user()->permission=='1')
@include('admin.sidebar')
@endif
@if(isset($food->id))
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
   <form action="{{route('postupdatefood')}}" method="post" enctype="multipart/form-data">
      <div class="row">
         <div class="col-sm-12">
            <div class="form-group">
               <label for="">Food Name</label>
               <input type="hidden" name="id" value="{{$food->id}}">
               <div class="form-group {{($errors->has('name'))?'has-error':''}}">
                  <input type="text" name="name" id="" class="form-control" placeholder="{{$errors->first('name')}}" value="{{$food->title}}" >
               </div>
            </div>
            <label for="">Chose Category</label>
            <div class="form-group" {{($errors->has('category'))?'has-error':''}}>
            <?php
               $categories=App\Category::all();
               ?>
            <?php $categoryList=array();?>
            @foreach($food->categories as $cate)
            <?php array_push($categoryList,$cate->id);?>
            @endforeach
            @foreach($categories as $category)
            <input type="checkbox" name="category[]" value="{{$category->id}}" id="" @if(in_array($category->id, $categoryList)) checked="checked" @endif>  {{$category->name}}
            @endforeach
         </div>
         <br>
      </div>
      <div class="col-sm-12">
         <div class="form-group {{($errors->has('description'))?'has-error':''}}">
            <label for="">Description</label>
            <textarea name="description" id="foodsdescription" class="my-editor">{{$food->description}}</textarea>
            @include('admin.textarea')
         </div>
         <div class="form-group">
            @if($food->images !='')
            <?php
               $explode=explode("||",$food->images);
               
               ?>
            @foreach($explode as $key => $image)
            <img src="{{URL::to('/')}}/uploads/{{$image}}" alt="" class="img-responsive">
            <h4>
               <a href="#" onclick="deleteImage('{{$food->id}}','{{$key}}','{{$image}}')">Delete Image</a>
            </h4>
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
<button type="submit" class="btn btn-info" style='border-radius:0px;'>Update  Foods</button>
<a href="{{route('getFoods')}}" class="btn btn-default">Go Back</a>
</div>
</div>
</div>
<input type="hidden" name="_token" value="{{Session::token()}}">
</form> 
</div>
@else
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
   <form action="{{route('postFood')}}" method="post" enctype="multipart/form-data">
      <div class="row">
         <div class="col-sm-12">
            <div class="form-group">
               <label for="">Food Name</label>
               <div class="form-group {{($errors->has('name'))?'has-error':''}}">
                  <input type="text" name="name" id="" class="form-control" placeholder="{{$errors->first('name')}}" >
               </div>
            </div>
            <label for="">Chose Category</label>
            <div class="form-group" {{($errors->has('category'))?'has-error':''}}>
            <?php
               $categories=App\Category::all();
               ?>
            @foreach($categories as $category)
            <input type="checkbox" name="category[]" value="{{$category->id}}" id="">  {{$category->name}}
            @endforeach
         </div>
         <br>
      </div>
      <div class="col-sm-12">
         <div class="form-group {{($errors->has('description'))?'has-error':''}}">
            <label for="">Description</label>
            <textarea name="description" id="foodsdescription" class="my-editor"></textarea>
            @include('admin.textarea')
         </div>
         <div class="form-group">
            <label for="">Chose Files</label>
            <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]" multiple="multiple">
         </div>
      </div>
</div>
<div class="row">
<br>
<br>
<div class="col-sm-12">
<div class="form-group text-right">
<button type="submit" class="btn btn-info" style='border-radius:0px;'>Save Foods</button>
</div>
</div>
</div>
<input type="hidden" name="_token" value="{{Session::token()}}">
</form>  
<div class="row">
   <div class="col-sm-12">
      <table class="table">
         <thead>
            <tr>
               <td>ID</td>
               <td>Name</td>
               <td>Description</td>
               <td>Category</td>
               <td>Action</td>
            </tr>
         </thead>
         <tbody>
            @foreach($foods as $food)
            <tr>
               <td>{{$food->id}}</td>
               <td>{{$food->title}}</td>
               <td>
                  <?php $categorylist=Null;?>
                  <?php $description=strip_tags($category->description);?>
                  <?php $sortText=substr($description, 0,100);?>
                  <?php echo $sortText."...";?>
               </td>
               <td>@foreach($food->categories as $category)
                  <?php $categorylist.=$category->name.",";?>
                  @endforeach
                  <?php echo $categorylist !=Null ? rtrim($categorylist,','):'No Category';?>
               </td>
               <td><a href="{{route('editfood',['id'=>$food])}}" class="fa fa-edit"></a> | <a href="{{route('deletefood',['id'=>$food])}}" onclick="return confirm('Are you sure to delete this post?')" class="fa fa-trash"></a></td>
            </tr>
            @endforeach
         </tbody>
      </table>
      {!! $foods ->render() !!}
   </div>
</div>
</div>
@endif
@stop