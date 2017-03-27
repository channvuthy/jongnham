@extends('layouts.master')
@section('title')
Jongnham
@stop
@section('content')
@include('inc.header')
<!--Start Main Body Section-->
<section class="main_body">
   <div class="container">
      <h3 class="list_food text-center">Latest Post</h3>
      <div class="row">
         @foreach($foods as $food)
         <div class="col-md-4 col-sm-6 col-xs-12 food">
            <div class="box_food text-center">
               <h2 class="title_post">{{$food->title}}</h2>
               <div class="img">
                  <?php $imageString=$food->images;?>
                  <?php $imageArray=explode("||",$imageString);?>
                  <?php $imageFile=$imageArray[0];?>
                  <a href="{{route('food_description',array(str_replace(' ', '-',strtolower($food->categories->first()->name)),str_replace(' ', '-',strtolower($food->title)),strtolower($food->id)))}}"><img src="{{asset('uploads')}}/{{$imageFile}}" alt="" class="height img-responsive"></a>
               </div>
               <br>
               
                  <?php
                     $description=strip_tags($food->description);
                     $short_description=mb_substr($description,0,100, "utf-8");
                     ?>
                  <div class="description dhome height">{{$short_description}}...</div>
               <p>
               <div class="read_more">
                  <a href="{{route('food_description',array(str_replace(' ', '-',strtolower($food->categories->first()->name)),str_replace(' ', '-', strtolower($food->title)),strtolower($food->id)))}}">More</a>
               </div>
               </p>
            </div>
         </div>
         @endforeach
      </div>
      <div class="row">
         <div class="row">
            <h3 class="text-center more">
               <div class="readmore"><a href="{{route('Categories')}}">More</a></div>
            </h3>
         </div>
      </div>
   </div>
   <div class="cat">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="text-center  food_cat">Popular Food Category</h3>
            </div>
            <div class="list_categories">
               @foreach($categories as $category)
               <div class="col-sm-6 col-md-4 col-xs-12 list_category">
                  <div class="boxcat">
                     <div class="name">
                        <p><a href="{{route('Category',array(str_replace(' ','-',strtolower($category->name)),$category->id))}}">{{$category->name}}</a></</p>
                     </div>
                     <div class="img_category">
                        <a href="{{route('Category',array(str_replace(' ','-',strtolower($category->name)),$category->id))}}"><img src="{{asset('uploads')}}/{{$category->image}}" alt="" class="img-responsive height"></a> 
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
   <!--End list category-->
   <!--Start Block About-->
   <div class="about_us">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <br>
               <h3 class="title_about text-center">
                  About Us
               </h3>
               <br>
               <p class="description_about_us">
                  {!!isset($about->description)?$about->description:''!!}
               </p>
            </div>
         </div>
      </div>
   </div>
   <br>
   <br>
   <br>
   <div class="slideCarousel">
      <div id="owl-example" class="owl-carousel">
         @foreach($foods as $food)
         <div class="each_carousel">
            <h2 class="title_carousel">{{$food->title}}</h2>
            <?php $imageString=$food->images;?>
            <?php $imageArray=explode("||",$imageString);?>
            <?php $imageFile=$imageArray[0];?>
            <a href="{{route('food_description',array(str_replace(' ','-',strtolower($food->categories->first()->name)),str_replace(' ','-',strtolower($food->title)),strtolower($food->id)))}}" data-hover="{{$food->title}}"><img src="{{asset('uploads')}}/{{$imageFile}}" alt="{{$food->title}}" class="img-responsive height "></a>
         </div>
         @endforeach
      </div>
   </div>
   <!--End of Owl Carousel-->
   <br>
   <br>
   <div class="container">
      <div class="block_contact">
         <div class="row">
            <div class="col-md-12">
               <h3 class="title_about text-center">
                  Contact Us
               </h3>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
               @if(session()->has('message'))
               <div class="alert alert-success">
                  {{session()->get('message')}}
               </div> 
               @endif
 
               <form action="{{route('contact')}}" method="post" id="about">
                  <div class="form-group">
                     <input type="hidden" name="_token" value="{{Session::token()}}"/>
                     <label for="">Full Name  <span style="color:red;">*</span></label>
                     <input type="text" name="name" id="" class="form-control" placeholder="Full Name" value="{{old('name')}}">
                     <span class="text-danger">{{$errors->first('name')}}</span>
                  </div>
                  <div class="form-group">
                     <label for="">Email  <span style="color:red;">*</span></label>
                     <input type="text" name="email" id="" class="form-control" placeholder="Email" value="{{old('email')}}">
                     <span class="text-danger">{{$errors->first('email')}}</span>
                  </div>
                  <div class="form-group">
                     <label for="">Message  <span style="color:red;">*</span></label>
                     <textarea name="message" id="" cols="30" rows="5" class="form-control" placeholder="Message">{{old('message')}}</textarea>
                     <span class="text-danger">{{$errors->first('message')}}</span>
                  </div>
                  <div class="form-group">
                     <button class="btn btn-primary" style="border-radius:0px;">Send</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!--End Main Body Section-->
<!--Start Footer Section-->
@include('inc.footer')
<!--End footer Section-->
@stop