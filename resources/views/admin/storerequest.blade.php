@section('content')
@extends('admin.master')
@section('title')
Store Request
@stop
@include('admin.header')
@include('admin.nav')
@if(Auth::user()->permission=='1')
@include('admin.sidebar')
@endif
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
         <li class="active">Store Request</li>
      </ol>
   </div>
   <!--/.row-->
   <br><br>
   <div class="row">
      <div class="col-sm-12">
         @if($errors->has('message'))
         <div class="alert alert-success">
            {{$errors->first('message')}}
         </div>
         @endif
      </div>
      <div class="col-sm-12">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Store Name</th>
                  <th>Created_a</th>
                  <th>Approval</th>
               </tr>
            </thead>
            <tbody>
               @foreach($storesRequests as $store)
               <tr>
                  <td>{{$store->id}}</td>
                  <td>{{$store->name}}</td>
                  <td>{{$store->created_at}}</td>
                  <td><a href="{{route('store.approve',['id'=>$store->id])}}">Approve Now</a> |  <a href="{{route('checktoactivate',['id'=>$store->id])}}"><i class="glyphicon glyphicon-eye-open"></i> View</a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <div class="clearfix"></div>
         <ul class="list-inline">
         	<li><a href="{{route('approall.store')}}"><i class="glyphicon glyphicon-ok"></i> Appro All Restaurant </a></li>
         	<li><a href="{{route('removeall.store')}}"><i class="glyphicon glyphicon-remove"></i> Remove All Restaurant</a></li>
         </ul>
      </div>
   </div>
</div>
</div>
@stop