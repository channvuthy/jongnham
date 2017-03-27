 @section('content')
@extends('admin.master')
@section('title')
    Stores
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
                <li class="active">Stores</li>
            </ol>
        </div><!--/.row-->
        <br>
        <div class="row">
        <div class="col-sm-12">
            @if($errors->has('message'))
                <div class="alert alert-success">
                    {{$errors->first('message')}}
                </div>
            @endif
        </div>
        <form action="{{route('postStore')}}" method="post" enctype="multipart/form-data">
            <div class="col-sm-6">
                <div class="form-group">
                <label for="Name">Name</label>
                  <small class="text-danger">{{$errors->first('name')}}</small>
                    <input type="text" name="name" id="" class="form-control">

                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label for="">Phone</label>
                <small class="text-danger">{{$errors->first('phone')}}</small>
                    <input type="text" name="phone" id="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label for="">Website/Page</label>
                <small class="text-danger">{{$errors->first('website')}}</small>
                    <input type="text" name="website" id="" class="form-control" placeholder="e.g http:://www.facebook.com/your_page">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label for="">Address</label>
                <small class="text-danger">{{$errors->first('address')}}</small>
                    <input type="text" name="address" id="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label for="">Map</label>
                    <input type="text" name="map" id="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label for="">Open</label>
                 <small class="text-danger">{{$errors->first('open')}}</small>
                    <input type="time" name="open" id="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                 <small class="text-danger">{{$errors->first('close')}}</small>
                    <label for="">Close</label>
                    <input type="time" name="close" id="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Location</label>
                    <select name="location" id="" class="form-control">
                        <?php
                            $locations=App\Models\Location::all();
                        ?>
                        @if(count($locations))
                            @foreach($locations as $location )
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Store Type</label>
                    <select name="store_type" id="" class="form-control">
                        <?php
                            $stores=App\Models\Store_Type::all();
                        ?>
                        @if(count($stores))
                            @foreach($stores as $store )
                                <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="10" class="my-editor"></textarea>
                    @include("admin.textarea")
                </div>
            </div>
                 <div class="col-sm-12">
                <div class="form-group">
                <label for="">Chose Files</label>
                    <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]" multiple="multiple">
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info" style="border-radius:0px;">Save</button>
            </div>

        </div>
        </form>
        <br>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Phone</td>
                            <td>Address</td>
                            <td>Website</td>
                            <td width="150px">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($all_stores))
                            @foreach($all_stores as $all_store)
                            <tr>
                                <td>{{$all_store->id}}</td>
                                <td>{{$all_store->name}}</td>
                                <td>{{$all_store->phone}}</td>
                                <td>{{$all_store->address}}</td>
                                <td>{{$all_store->website}}</td>
                                <td>
                                <a href="{{route('get.edit.store',array('id'=>$all_store->id,'key'=>bcrypt($all_store->id)))}}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{route('getDeleteStore',array('id'=>$all_store->id,'key'=>bcrypt($all_store->id)))}}" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
{!! $all_stores ->render() !!}
            </div>
        </div>
</div>
@stop