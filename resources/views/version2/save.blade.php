@extends('version2.layouts.master')
@section('title')
All Saved
@stop
@section('content')
<div class="save">
@include('version2.layouts.inc.headerrestuarant')
</div>
<div class="container">
   <div class="row __clear__margin">
      <h3 class="text-center __saved-article">Saved</h3>
      <div class="__block__sorting">
         <ul class="list-inline">
            <li><a href="?">Sort By</a></li>
            <li <?php if(isset($_GET['sortBy'])):?> <?php if($_GET['sortBy']=='Ranking'):?> class='active' <?php endif;?> <?php endif;?>><a href="?sortBy=Ranking">Ranking</a></li>
            <li <?php if(isset($_GET['sortBy'])):?> <?php if($_GET['sortBy']=='Name'):?> class='active' <?php endif;?> <?php endif;?>><a href="?sortBy=Name">Name</a></li>
            <li <?php if(isset($_GET['sortBy'])):?> <?php if($_GET['sortBy']=='View'):?> class='active' <?php endif;?> <?php endif;?>><a href="?sortBy=View">View</a></li>
            <li <?php if(isset($_GET['sortBy'])):?> <?php if($_GET['sortBy']=='Price'):?> class='active' <?php endif;?> <?php endif;?>><a href="?sortBy=Price">Price</a></li>
         </ul>
         <div class="pull-right">
            <ul class="list-inline">
               <li>
               	<form action="{{route('clear.allsaved')}}" method="post">
                 
                  <input type="hidden" name="clearall" id="clear">
                  <input type="hidden" name="_token" value="{{Session::token()}}">
                  <script type="text/javascript">
                     var catID="";
                     @foreach(Auth::user()->saveStoreOrderByRating as $store)
                     catID+={{$store->id}}+",";
                     
                     @endforeach
                     var trim = catID.replace(/(^,)|(,$)/g, "")
                     $("#clear").val(trim);
                  </script>
                  <button type="submit" class="clear_save">Clear All</button>
                  </form>
               </li>
            </ul>
         </div>
      </div>
      <br>
      @if(isset($_GET['sortBy']))
      @if($_GET['sortBy']=="Ranking")
      @foreach(Auth::user()->saveStoreOrderByRating as $store)
      <div class="__border__save __saved-list">
         <div class="__save__unsave pull-right">
            <a href="{{route('clearsaveonebyonce',array('storeID'=>$store->id))}}"><i class="fa fa-bookmark"></i></a>
         </div>
         <div class="col-md-4 __clear__padding__left">
            @php
            $imageArray=explode("||",$store->images);
            @endphp
            @if(empty($store->images))
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>
            @else
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
            @endif
         </div>
         <div class="col-md-8">
            <b><a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</a></b>
            <p>Rate 
               @php
               $star=ceil($store->rating);
               @endphp
               @foreach(range(1,5) as $rate)
               @if($rate<=$star)
               <i class="fa fa-star rated"></i>
               @else
               <i class="fa fa-star"></i>
               @endif
               @endforeach
               <span>(view {{$store->view}})</span>
            </p>
            <address>{{$store->address}}</address>
         </div>
         <div class="clearfix"></div>
      </div>
      @endforeach
      @elseif($_GET['sortBy']=="Name")
      @foreach(Auth::user()->saveStoreOrderByName as $store)
      <div class="__border__save __saved-list">
         <div class="__save__unsave pull-right">
            <a href="{{route('clearsaveonebyonce',array('storeID'=>$store->id))}}"><i class="fa fa-bookmark"></i></a>
         </div>
         <div class="col-md-4 __clear__padding__left">
            @php
            $imageArray=explode("||",$store->images);
            @endphp
            @if(empty($store->images))
            
                        <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>
            @else
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
            @endif
         </div>
         <div class="col-md-8">
            <b><a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</b></a>
            <p>Rate 
               @php
               $star=ceil($store->rating);
               @endphp
               @foreach(range(1,5) as $rate)
               @if($rate<=$star)
               <i class="fa fa-star rated"></i>
               @else
               <i class="fa fa-star"></i>
               @endif
               @endforeach
               <span>(view {{$store->view}})</span>
            </p>
            <address>{{$store->address}}</address>
         </div>
         <div class="clearfix"></div>
      </div>
      @endforeach
      @elseif($_GET['sortBy']=="View")
      @foreach(Auth::user()->saveStoreOrderByView as $store)
      <div class="__border__save __saved-list">
         <div class="__save__unsave pull-right">
            <a href="{{route('clearsaveonebyonce',array('storeID'=>$store->id))}}"><i class="fa fa-bookmark"></i></a>
         </div>
         <div class="col-md-4 __clear__padding__left">
            @php
            $imageArray=explode("||",$store->images);
            @endphp
           
            @if(empty($store->images))
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>
            @else
                     <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
            @endif
   
   
         </div>
         <div class="col-md-8">
            <b><a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</b></a>
            <p>Rate 
               @php
               $star=ceil($store->rating);
               @endphp
               @foreach(range(1,5) as $rate)
               @if($rate<=$star)
               <i class="fa fa-star rated"></i>
               @else
               <i class="fa fa-star"></i>
               @endif
               @endforeach
               <span>(view {{$store->view}})</span>
            </p>
            <address>{{$store->address}}</address>
         </div>
         <div class="clearfix"></div>
      </div>
      @endforeach
      @elseif($_GET['sortBy']=="Price")
      @foreach(Auth::user()->saveStoreOrderByPrice as $store)
      <div class="__border__save __saved-list">
         <div class="__save__unsave pull-right">
            <a href=""><i class="fa fa-bookmark"></i></a>
         </div>
         <div class="col-md-4 __clear__padding__left">
            @php
            $imageArray=explode("||",$store->images);
            @endphp
            @if(empty($store->images)) 
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>
            @else
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
            @endif
         </div>
         <div class="col-md-8">
            <b><a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</b></a>
            <p>Rate 
               @php
               $star=ceil($store->rating);
               @endphp
               @foreach(range(1,5) as $rate)
               @if($rate<=$star)
               <i class="fa fa-star rated"></i>
               @else
               <i class="fa fa-star"></i>
               @endif
               @endforeach
               <span>(view {{$store->view}})</span>
            </p>
            <address>{{$store->address}}</address>
         </div>
         <div class="clearfix"></div>
      </div>
      @endforeach
      @endif
      @else
      @foreach(Auth::user()->saveStoreOrderByRating as $store)
      <div class="__border__save __saved-list">
         <div class="__save__unsave pull-right">
            <a href="{{route('clearsaveonebyonce',array('storeID'=>$store->id))}}"><i class="fa fa-bookmark"></i></a>
         </div>
         <div class="col-md-4 __clear__padding__left">
            @php
            $imageArray=explode("||",$store->images);
            @endphp
            @if(empty($store->images))
                 <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>
            @else
                 <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
            @endif
       
         </div>
         <div class="col-md-8">
            <b><a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</b></a>
            <p>Rate 
               @php
               $star=ceil($store->rating);
               @endphp
               @foreach(range(1,5) as $rate)
               @if($rate<=$star)
               <i class="fa fa-star rated"></i>
               @else
               <i class="fa fa-star"></i>
               @endif
               @endforeach
               <span>(view {{$store->view}})</span>
            </p>
            <address>{{$store->address}}</address>
         </div>
         <div class="clearfix"></div>
      </div>
      @endforeach
      @endif
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
     		$('#table').DataTable();
   });
</script>
@stop