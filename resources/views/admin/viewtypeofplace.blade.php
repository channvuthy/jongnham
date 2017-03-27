 @section('content')
@extends('admin.master')
@section('title')
   View  Type of  Place
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
                <li class="active">View Type of  Place</li>
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

                    <li><a href="{{route('addtypeofplace')}}" class="btn btn-danger btn-xs">View Type of  Place</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
               <form action="{{route('postUpdateTypeofPlace')}}" method="post" >
                   <input type="hidden" name="_token" value="{{Session::token()}}">
                   <input type="hidden" name="id" value="{{$Typeofplace->id}}">
                   <div class="form-group">
                        <label for="">Place Name</label>
                       <input type="text" name="placename" id="" class="form-control" value="{{$Typeofplace->placename}}">
                   </div>
                   <div class="form-group">
                       <label for="">Description</label>
                       <textarea name="description" id="" cols="30" rows="5" class="form-control">{{$Typeofplace->description}}</textarea>
                   </div>
                   <div class="form-group">
                       <button type="submit" class="btn btn-primary">Update</button>
                   </div>
               </form>

            </div>
        </div>
</div>
@stop

