@extends('layouts.master')
@section('title')
Categories
@stop
@section('content')
@include('inc.headersubpage')
<div class="box_category">
   <div class="container">
      <div class="col-sm-12">
         <h3 class="text-center  food_cat" style="margin-top: -45px;
            margin-bottom: 55px;">Food Category</h3>
      </div>
      @foreach($categories as $category)
      <div class="col-sm-6 col-xs-12 col-md-4 list_category">
         <div class="img_category">
            <div class="opacity">
               <div class="title_category">
                  <h3><a href="{{route('Category',array(str_replace(' ','-',$category->name),$category->id))}}">{{$category->name}}</a></h3>
               </div>
               <a href="{{route('Category',array(str_replace(' ','-',$category->name),$category->id))}}" onclick="return categoryAVG(1);"><img src="{{asset('uploads')}}/{{$category->image}}" class="img-responsive height" alt=""></a>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@include('inc.footer')
@stop