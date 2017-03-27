@extends('admin.master')
@section('title')
    Administrator
@stop
@section('content')
<div class="container">
    <div class="col-sm-6 col-sm-offset-3">
        <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">
            <div class="login_form">
                <div class="login_header">
                    <h3>Login</h3>
                </div>
                <div class="form-group">
                    <input type="text" name="email" id="" class="form-control" placeholder="Email">
                    <small class="text-danger">{{$errors->first('email')}}</small>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                    <small class="text-danger">{{$errors->first('password')}}</small>
                </div>
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop