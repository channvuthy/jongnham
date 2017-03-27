@extends('layouts.master')
@section('title')
Search
@stop
@section('content')
@include('inc.headersubpage')
<div class="container">
   <div class="row">
      <br>
      <div class="col-sm-12">
         <h3 class="title search_result text-center">
            Search Results
         </h3>
      </div>
      <br>
      <br>
      <br>
   </div>
   <div class="row">
      @foreach($foods as $food)
      <div class="col-sm-6 col-md-4 food">
         <div class="box_food text-center padding0">
            <h3 class="search_title"><a href="{{route('food_description',array(str_replace(' ', '-',$food->categories->first()->name),str_replace(' ', '-', $food->title),$food->id))}}">{{$food->title}}</a></h3>
            <div class="img">
               <?php $imageString=$food->images;?>
               <?php $imageArray=explode("||",$imageString);?>
               <?php $imageFile=$imageArray[0];?>
               <a href="{{route('food_description',array(str_replace(' ', '-',$food->categories->first()->name),str_replace(' ', '-', $food->title),$food->id))}}">
               @if(empty($food->images))
                <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive">
               @else
               <img src="{{asset('uploads')}}/{{$imageFile}}" alt="" class="img-responsive">
               @endif
               </a> 
            </div>
            <br>
            
               <?php
                  $description=strip_tags($food->description);
                  $short_description=mb_substr($description, 0,100);
                  ?>
               <div class="description" style="padding:10px;">{{$short_description}}...</div>
            <p>
            <div class="read_more">
               <a href="{{route('food_description',array(str_replace(' ', '-',$food->categories->first()->name),str_replace(' ', '-', $food->title),$food->id))}}">More</a>
            </div>
            </p>
         </div>
      </div>
      @endforeach
   </div>
</div>
@stop