@extends('admin.master')
@section('title')
    Update Profile
@stop
@section('content')
@include('admin.header')
@include('admin.nav')
    @if(Auth::user()->permission=='1')
        @include('admin.sidebar')
    @endif

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Update Profile</li>
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
        <br>
        <div class="col-sm-12">
            <small class="text-danger">{{$errors->first('password')}}</small>
        </div>
        <form action="{{route('updateuser')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="col-sm-6">
                <label for="name">Username</label>
                <div class="form-group">
                    <input type="text" name="username" id="" class="form-control"  value="{{$user->username}}">
                </div>
            </div>
            <div class="col-sm-6">
            <label for="">Email Address</label>
                <div class="form-group">
                    <input type="text" name="email" id="" class="form-control" value="{{$user->email}}">
                </div>
            </div>
            <div class="col-sm-6">
            <label for="">Password</label>
                <div class="form-group">
                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                </div>

            </div>
            <div class="col-sm-6">
            <label for="">Sex</label>
                <div class="form-group">
                    <input type="text" name="sex" id="" class="form-control" value="{{$user->sex}}">
                </div>
            </div>
              <div class="col-sm-6">
              <label for="">Address</label>
                <div class="form-group">
                    <input type="text" name="address" id="" class="form-control" value="{{$user->address}}">
                </div>

            </div>
             <div class="col-sm-6">
             <label for="">Phone</label>
                <div class="form-group">
                    <input type="text" name="phone" id="" class="form-control" value="{{$user->phone}}">
                </div>
             </div>
             <div class="col-sm-6">
             <label for="">Date Of Birth</label>
                <div class="form-group">
                    <input type="date" name="date_of_birth" id="" class="form-control" value="{{$user->date_of_birth}}">
                </div>
             </div>
            <div class="col-sm-6">
            <label for="">Photo</label>
                <div class="form-group">
                    <input type="file" name="photo" id="inputFile" class="form-control">
                    <input type="hidden" name="photo" value="{{$user->photo}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Update Profile</button>
                </div>
            </div>
            <div class="col-sm-6">
                 <div class="form-group">
                    <div class="profile_image">
                        @if($user->photo)
                        <img src="{{asset('uploads/')}}/{{$user->photo}}" alt="" class="img-thumbnail" id="image_upload_preview">
                        @else
                        <img src="{{asset('uploads/default.jpg')}}" alt="" class="img-thumbnail" id="image_upload_preview">
                        @endif
                    </div>
                </div>
            </div>
            </form>
        </div>
</div>

@stop