@extends('layouts.master')
@section('title')
{{$get_the_title_category}}
@stop
@section('content')
@include('inc.headersubpage')
<div class="specefic_category">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <h3 class="text-center specefic_category_title">
               {{$get_the_title_category}}
            </h3>
         </div>
         @foreach($the_list_post_in_category as $foodInCategory)
         <div class="col-sm-6 col-md-4 col-xs-12 food">
            <div class="block_specefic_category_title">
               <div class="text-center">
                  <h3 class="text-center title"><a href="{{route('food_description',array(str_replace(' ','-',$get_the_title_category),str_replace(' ', '-',$foodInCategory->title),$foodInCategory->id))}}">{{$foodInCategory->title}}</a></h3>
                  <div class="img">
                     <?php $the_image_array=explode("||", $foodInCategory->images);?>
                     <img src="{{asset('uploads')}}/{{$the_image_array[0]}}" alt="" class="img-responsive height"> 
                  </div>
                  <br>
                  <div class="description">
                     <?php $the_short_description=strip_tags($foodInCategory->description);?>
                     <?php $the_short_description=mb_substr($the_short_description,0,100);?>
                     {{$the_short_description}}...
                  </div>
                  <div class="read_more">
                     <p><a href="{{route('food_description',array(str_replace(' ','-',$get_the_title_category),str_replace(' ', '-',$foodInCategory->title),$foodInCategory->id))}}">More</a></p>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
@include('inc.footer')
@stop