 @section('content')
@extends('admin.master')
@section('title')
    Type of Food
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
                <li class="active">Type of Food</li>
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
                    <li><a href="{{route('addtypeoffood')}}" class="btn btn-danger btn-xs">Add Type of Food</a></li>
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
                    @foreach($typeoffoods as $typeoffood)
                        <tr>
                            <td>{{$typeoffood->name}}</td>
                            <td>{{$typeoffood->description}}</td>
                            <td>@if($typeoffood->status=="1") Published @else Unpublished @endif </td>
                            <td>{{$typeoffood->created_at}}</td>
                            <td><a href="{{route('getViewTypeofFood',['id'=>$typeoffood->id])}}" class="btn btn-info btn-xs">View</a>   <a onclick="return confirm('Are you sure to delete item?')" href="{{route('getDeleteTypeofFood',array('id'=>$typeoffood->id))}}" class="btn btn-danger btn-xs">Delete</a></td>
                           
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
</div>
@stop

