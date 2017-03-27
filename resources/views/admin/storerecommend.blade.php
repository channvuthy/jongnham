@section('content')
@extends('admin.master')
@section('title')
Recommended
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
      <li class="active">Store Recommended</li>
   </ol>
</div>
<!--/.row-->
<div class="row">
<br>
<br>
<div class="col-md-12">
    <h4>All Store Recommended</h4>
    <table class="table-bordered table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created_a</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($recommend as $re)
                <tr>
                    <td>{{$re->id}}</td>
                    <td>{{$re->name}}</td>
                    <td>{{$re->created_at}}</td>
                    <td><a href="store-unrecommended/{{$re->id}}">Unrecommended</a></td>
                </tr>
        @endforeach

        </tbody>
    </table>
    {!!$recommend->render()!!}
    <hr>
    <h4>Add More Recommended Store</h4>
     <table class="table-bordered table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created_a</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($alls as $all)
            <tr>
                <td>{{$all->id}}</td>
                <td>{{$all->name}}</td>
                <td>{{$all->created_at}}</td>
                <td><a href="recommend-now/{{$all->id}}">Recommended Now</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!$alls->render()!!}
</div>
</div>
@stop