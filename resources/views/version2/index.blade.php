@extends('version2.layouts.master')
@section('title')
Find Countless Interesting Restaurants in Phnom Penh
@stop
@section('content')
@include('version2.layouts.inc.mainheader')
<div class="container">
   <div class="row">
      <h2 class="__title_restaurant text-center">
         <img src="{{URL::to('/')}}/uploads/top-rate.png" alt=""> Top Rated Restaurant
      </h2>
   </div>
   <div class="row">
      @foreach($stores as $store)
      <div class="col-md-4 block-homepage height">
        @if(!empty($store->images))
            <?php $imageArray=explode("||",$store->images);?>
            <div class="limitHieght">
               <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive __imge_restaurant "></a>

            </div>
        @else
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive __imge_restaurant "></a>
        @endif
         
         <div class="__save">
            @if(Auth::check())
            @php
            $saved = DB::table('user__saves')
            ->wherestore_id($store->id)
            ->whereuser_id(Auth::user()->id)
            ->count() > 0;
            @endphp
            @if($saved>0)
            <a href="{{route('store.destory',array('userID'=>\Auth::user()->id,'storeID'=>$store->id,'key'=>bcrypt($store->name)))}}"><i class="fa fa-bookmark pull-right" style="color:darkorange" title="Remve Save"></i></a>
            @else
            <a href="{{route('store.save',array('userID'=>\Auth::user()->id,'storeID'=>$store->id,'key'=>bcrypt($store->name)))}}"><i class="fa fa-bookmark pull-right" title="Save Now"></i></a>
            @endif
            @else
            <a href="#" onclick="login__form();"><i class="fa fa-bookmark pull-right"></i></a>
            @endif
         </div>
         <h3><a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</a></h3>
         <p>Rate
            @php
            $star=ceil($store->rating);
            @endphp
            @foreach(range(1,5) as $rate)
            @if($rate<=$star)
            <i class="fa fa-star rated"></i>
            @else
            <i class="fa fa-star "></i>
            @endif
            @endforeach
            <span class="view">(view {{$store->view}})</span>
         </p>
         <p>{{substr($store->address,0,30)}}...</p>
      </div>
      @endforeach
   </div>
</div>
<!--/.popular search-->
<div class="container-fluid __popular_restaurant">
   <div class="__list__popular_resaurant">
      <div class="container">
         <div class="row">
            <h2 class="text-center title__popular"><img src="{{asset('uploads')}}/pop-cate.png" alt=""> Popular Restaurant Dish</h2>
         </div>
         <div class="row">
         @foreach($populars as $popular)
            <div class="col-md-4 block-homepage-pop">
               <div class="__pop">
                        @if(empty($popular->images))
                             <div class="imagePopular height" style="overflow: hidden;">
                             <a href="{{route('getRestaurantDetail',array('name'=>$popular->name,'id'=>$popular->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive __imge_restaurant"></a>
                           </div>
                           <h3 class="popular__title text-center"><a href="{{route('getRestaurantDetail',array('name'=>$popular->name,'id'=>$popular->id))}}">{{$popular->name}}</a></h3>
                        @else
                        @php
                        $imageArray=explode("||", $popular->images);
                        @endphp
                        <div class="imagePopular height" style="overflow: hidden;">
                             <a href="{{route('getRestaurantDetail',array('name'=>$popular->name,'id'=>$popular->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive __imge_restaurant"></a>
                           </div>
                           <h3 class="popular__title text-center"><a href="{{route('getRestaurantDetail',array('name'=>$popular->name,'id'=>$popular->id))}}">@if(strlen($popular->name) >20) {{substr($popular->name,0,20)}} ... @else {{$popular->name}} @endif</a></h3>
                     @endif
                   </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
</div>
<!--About us-->
<div class="container-fluid __about">
   <div class="container">
      <h2 class="text-center __about_title">
         About
      </h2>
      <div>
         @php
            $about=App\Models\About::first();
         @endphp
         {!!$about->description!!}
      </div>
   </div>
</div>
<!--Blog Kher Food-->
<div class="container-fluid __old__version">
   <div class="container">
      <div class="row">
      <h2 class="__khmer__food text-center">Khmer Food</h2>
         @foreach($foods as $food)
           <div class="col-md-6 block-homepage-pop old-post height">
            <div class="row">
               <div class="col-md-6">
               @php
                  $imageArray=explode("||" , $food->images);
               @endphp
                 <a href="{{route('food_description',array(str_replace(' ','-',strtolower($food->categories->first()->name)),str_replace(' ','-',strtolower($food->title)),strtolower($food->id)))}}" data-hover="{{$food->title}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>

               </div>
               <div class="col-md-6">
                  <h4><b><a href="{{route('food_description',array(str_replace(' ','-',strtolower($food->categories->first()->name)),str_replace(' ','-',strtolower($food->title)),strtolower($food->id)))}}" data-hover="{{$food->title}}">{{$food->title}}</b></a></h4>
                  @php
                     $description=strip_tags($food->description);
                        $short_description=mb_substr($description,0,100, "utf-8");
                  @endphp
                  {{$short_description}}...
               </div>
            </div>
         </div>
         @endforeach
         
      </div>
   </div>
</div>

<div class="container-fluid __contact-as">
   <div class="container">
      <div class="block_contact-as">
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
</div>

<footer>
   <div class="__footer">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               &copy; Jongnhams All Right Reserved
            </div>
            <div class="col-md-6">
               <ul class="list-inline pull-right">
                  <li><a href="https://www.facebook.com/jongnhams/"><span class="fa fa-facebook"></span></a></li>
                  <li><a href=""><span class="fa fa-google"></span></a></li>
                  <li><a href=""><span class="fa fa-youtube"></span></a></li>
                  <li><a href=""><span class="fa fa-twitter"></span></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</footer>
<style type="text/css">
   .__list__popular_resaurant{
      position: relative;  
   }
      .__list__popular_resaurant:before{
                   content: "";
                   background-image: url(http://localhost:8000/uploads/bgp.jpg);
                   background-attachment: fixed;
                   background-size: cover;
                   background-repeat: no-repeat;
                   position: absolute;
                   width: 100%;
                   height: 100%;
                   z-index: -1;
                   opacity: 0.6;

         }
         h2.text-center.title__popular {
            
         }
</style>
@stop