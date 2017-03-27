 @section('content')
@extends('admin.master')
@section('title')
    Bookmark 
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
                <li class="active">Bookmark</li>
            </ol>
        </div><!--/.row-->
            <div class="row">
            <br>
        @if(count($bookmarks))
        @else
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <h3 style="margin:0px;padding:0px;">No Bookmark</h3>
                </div>
            </div>
        @endif
    </div>
    </div>

@stop