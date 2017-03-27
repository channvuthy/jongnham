 @section('content')
@extends('admin.master')
@section('title')
    Add Type of  Place
@stop
@include('admin.header')
@include('admin.nav')
    @if(Auth::user()->permission=='1')
        @include('admin.sidebar')
    @endif

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Add Type of  Place</li>
            </ol>
        </div><!--/.row-->
         <div class="row">
                  <div class="col-sm-12">
                    @if($errors->has('message'))
                        <div class="alert alert-success">
                            {{$errors->first('message')}}
                        </div>
                    @endif
                </div>
         </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline">

                    <li><a href="{{route('addtypeofplace')}}" class="btn btn-danger btn-xs">Add Type of  Place</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($Typeofplaces as $Typeofplace)
                        <tr>
                            <td>{{$Typeofplace->placename}}</td>
                            <td>{{$Typeofplace->description}}</td>
                            <td>@if($Typeofplace->status=="1") Published @else Unpublished @endif</td>
                            <td>{{$Typeofplace->created_at}}</td>
                            <td><a href="{{route('getViewTypeofPlace',array('id'=>$Typeofplace->id))}}" class="btn btn-info btn-xs">View</a> <a onclick="return confirm('Are you sure to delete ?')" href="{{route('getDeleteTypeofPlace',array('id'=>$Typeofplace->id))}}" class="btn btn-warning btn-xs">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
</div>
@stop

