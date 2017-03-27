@section('content')
@extends('admin.master')
@section('title')
    Locations
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
                <li class="active">Locations</li>
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
                        <td>Address</td>
                        <td>Description</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{$location->id}}</td>
                            <td>{{$location->name}}</td>
                            <td>
                                <?php
                                    $string=$location->description;
                                    $stringArray=explode(" ",$string);
                                    $newArray=array_slice($stringArray,0,5);
                                    foreach($newArray as $array){
                                        echo $array." ";
                                    }   
                                    echo "....";
                                ?>
                            </td>
                            <td>
                                <div class="glyphicon glyphicon-pencil" onclick="editLocation('{{$location->id}}','{{$location->name}}','{{$location->description}}')"></div> | <div class="glyphicon glyphicon-trash" onclick="deleteLocation('{{$location->id}}')"></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <form action="{{route('postLocation')}}" method="post" enctype="multipart/form-data">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="">Location Name</label>
                                <input type="text" name="address" id="" class="form-control">
                                <small class="text-danger">{{$errors->first('address')}}</small>
                            </div>
                            <div class="form-group">
                            <label for="">Description</label>
                                <textarea name="description" id=""  rows="5" class="form-control"></textarea>
                                <input type="hidden" name="_token"  value="{{Session::token()}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" style="border-radius:0px;">Save</button>
                            </div>
                        </div>
            </form>
    </div>
</div>
<!--Modal-->
    <div class="modal modalLocation fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><div class="glyphicon glyphicon-map-marker"></div>&nbsp;&nbsp;Update Location</h4>
            <div class="clearfix"><br></div>
            <div class="row">
                <form action="{{route('postUpdateLocation')}}" method="post" enctype="multipart/form-data">
                <div class="col-sm-12">
                <div class="form-group">
                    <input type="hidden" name="id_location" id="id_location">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </div>
                      <div class="form-group">
                        <input type="text" name="address" id="address_location" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="description_location" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group text-right">
                       <button type="submit" class="btn btn-info" style="border-radius:0px;">Update</button>
                    </div>
                    </form>
                </div>
            </div>
      </div>
        </div>
      </div>
</div>
@stop