@extends('admin.master')
@section('title')
Administrator
@stop
@section('content')
@include('admin.header')
@include('admin.nav')
@if(Auth::user()->permission=='1')
@include('admin.sidebar')
@else
Header
@endif
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
   <div class="row">
      <ol class="breadcrumb">
         <li>
            <a href="#">
               <svg class="glyph stroked home">
                  <use xlink:href="#stroked-home"></use>
               </svg>
               Dashboard
            </a>
         </li>
      </ol>
   </div>
   <!--/.row-->
   <!--/.row-->
   <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-12">
      <div class="col-md-2">
         @php
            $user=App\Models\User::all();
         @endphp
         <div class="box_user">
            <h4>User</h4>
            <hr>
           <a href="users"> <span>{{count($user)}}</span><i class="fa fa-user"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
            $store=App\Models\Store::all();
         @endphp
         <div class="box_user">
         <h4>Store</h4>
         <hr>
             <a href="get-all-store"> <span>{{count($store)}}</span><i class="fa fa-building"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
            $food=App\Models\Food::all();
         @endphp
         <div class="box_user">
         <h4>Food</h4>
         <hr>
            <a href="food"> <span>{{count($food)}}</span><i class="fa fa-cutlery"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
         $location=App\Models\Location::all();
         @endphp
         <div class="box_user">
         <h4>Location</h4>
         <hr>
            <a href="locations"> <span>{{count($location)}}</span><i class="fa fa-map-marker"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
            $typeofplace=App\Models\Typeofplace::all();
         @endphp
         <div class="box_user">
         <h4>Place</h4>
         <hr>
            <a href="get-type-of-place"><span> {{count($typeofplace)}}</span><i class="fa fa-globe"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
         $typeoffood=App\Models\Typeoffood::all();
         @endphp
          <div class="box_user">
          <h4>Category Food</h4>
          <hr>
            <a href="get-type-of-food"> <span>{{count($typeoffood)}}</span><i class="fa fa-lemon-o"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
         $storeRequest=App\Models\Store::where('approval','0')->get();
         @endphp
          <div class="box_user">
          <h4>Store Request</h4>
          <hr>
            <a href="store-request"> <span>{{count($storeRequest)}}</span><i class="fa fa-building"></i></a>
         </div>
      </div>
      <div class="col-md-2">
         @php
         $storeRequest=App\Models\Store::where('recommended','1')->get();
         @endphp
          <div class="box_user">
          <h4>Recommend Store</h4>
          <hr>
            <a href="store-recommend"> <span>{{count($storeRequest)}}</span><i class="fa fa-building"></i></a>
         </div>
      </div>
       <div class="col-md-2">
        
          <div class="box_user">
          <h4>Logout</h4>
          <hr>
            <a href="logout"> <span></span><i class="fa fa-lock"></i></a>
         </div>
      </div>
      </div>
   </div>
</div>
<!--/.main-->
@include('admin.footer')
@stop