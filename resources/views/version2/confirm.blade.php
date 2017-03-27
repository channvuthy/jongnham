@extends('version2.layouts.master')
@section('title')
   Confirmation Restuarant
@stop
@section('content')
   <br>
   <div class="container">
       <div class="panel panel-danger __clear__border">
         <div class="panel-heading">Your Restuarant</div>
         <div class="panel-body">
            <div class="col-md-5">
               @php
                  $imageArray=explode("||",$store->images);
                 $array=explode(" '\W' ",$store->businnesshour);
               @endphp
               <img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive">
            </div>
            <div class="col-md-7">
               <p><b>Name:</b> {{$store->name}}</p>
               <p><b>Email:</b> {{$store->email}}</p>
               <p><b>Phone:</b> {{$store->phone}}</p>
               <p><b>Website:</b> {{$store->website}}</p>
               <p><b>Address:</b> {{$store->address}}</p>
               <p><b>Working Hour:</b></p>
               <p>
                  @foreach($array as $value)
                  {{$value}}
                  @endforeach
               </p>
            </div>
         </div>
       </div>
   </div>
@stop