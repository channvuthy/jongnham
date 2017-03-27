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
            <form action="{{route('postUpdateTypeofFood')}}" method="post">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li><button class="btn btn-danger btn-xs">Edit Type of Food</button></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" value="{{$Typeoffood->name}}">
                        <input type="hidden" name="id" id="" class="form-control" value="{{$Typeoffood->id}}">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$Typeoffood->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Type of Food</button>
                    </div>
                </div>
            </form>
            
        </div>
</div>
@stop

