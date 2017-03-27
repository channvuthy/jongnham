@extends('layouts.master')
@section('title')
{{$detail->title}}
@stop
@section('content')
@include('inc.headersubpage')
<div style="background-color: #fff;margin-bottom: -50px;padding-bottom: 50px;">
<div class="container">
   <div class="row">
      <div class="col-md-8 author col-sm-6 col-xs-12">
         <br>
         <h2>{{$detail->title}}</h2>
         <br>
         <p> Date:{{ $detail->created_at->format(' M d, Y') }} | Category:@foreach($detail->categories as $category)
            <a href="{{route('Category',array(str_replace(' ', '-', strtolower($category->name)),$category->id))}}">{{$category->name}}</a><span class="comma">,</span>
            @endforeach
         </p>
         <hr style="margin-top:10px;">
         <div class="description">{!!$detail->description!!}</div>
         <div class="clearfix" style="clear:both;"></div>
         <div class="btnshare">
         <a href="{{Share::load(route('food_description',array(str_replace(' ', '-', strtolower($category->name)),str_replace(' ', '-',strtolower($detail->title)),$detail->id)))->facebook()}}" target="_blank"><img src="{{asset('uploads')}}/share.png"></a>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="col-md-4 sidebardetail" col-sm-6 col-xs-12>
         <h2 class=" title"> Popular Article</h2>
         @foreach($the_category as $the_post_category)
         <div class="popular_title">
            <h3 class="text-center"><a href="{{route('food_description',array(str_replace(' ','-',strtolower($the_post_category->categories->first()->name)),str_replace(' ','-',strtolower($the_post_category->title)),$the_post_category->id))}}">{{$the_post_category->title}}</a></h3>
            <div class="date_time">
               <span>{{ $detail->created_at->format('M') }}</span>
               <span>{{ $detail->created_at->format('d') }}</span>
            </div>
         </div>
         <?php $imageArray=explode("||",$the_post_category->images);?>
         <a href="{{route('food_description',array(str_replace(' ','-',strtolower($the_post_category->categories->first()->name)),str_replace(' ','-',strtolower($the_post_category->title)),strtolower($the_post_category->id)))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
         <br>
         @endforeach
      </div>
   </div>
</div>
</div>
@include('inc.footer')
@stop