@section('content')
@extends('admin.master')
@section('title')
    Region
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
                <li class="active">Regions</li>
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
        <div class="col-sm-7">
            <table class="table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($regions))
                    @foreach($regions as $region)
                        <tr>
                        <td>{{$region->id}}</td>
                        <td>{{$region->name}}</td>
                        <td>
                            <?php
                                    $string=$region->description;
                                    $stringArray=explode(" ",$string);
                                    $newArray=array_slice($stringArray,0,10);
                                    foreach($newArray as $array){
                                        echo $array." ";
                                    } 
                                    echo "....";  
                                ?>
                        </td>
                        <td><div class="glyphicon glyphicon-pencil" onclick="editRegion('{{$region->id}}','{{$region->name}}','{{$region->description}}')"></div> | <div class="glyphicon glyphicon-trash" onclick="deleteRegion('{{$region->id}}')"></div></td>
                        </tr>
                    @endforeach
                    
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-sm-5">
            <form action="{{route('postRegion')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Region Name</label>
                    <input type="text" name="region" id="" class="form-control">
                    <small class="text-danger">{{$errors->first('region')}}</small>
                </div>
                <div class="form-group">
                     <label for="">Description</label>
                    <textarea name="description" id=""  rows="5" class="form-control my-editor"></textarea>
                    @include("admin.textarea")
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info" style="border-radius:0px;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal modalRegion fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><div class="glyphicon glyphicon-map-marker"></div>&nbsp;&nbsp;Update Regions</h4>
            </div>
        <div class="container-fluid">
                   <div class="row">
                <div class="col-sm-12">
                <form action="{{route('postUpdateRegion')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Region Name</label>
                        <input type="text" name="region" id="region_name" class="form-control">
                        <input type="hidden" name="region_id" id="region_id">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="description_region"  rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-info" style='border-radius:0px'>Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
  </div>
</div>
@stop