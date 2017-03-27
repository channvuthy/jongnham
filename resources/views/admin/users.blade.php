@section('content')
@extends('admin.master')
@section('title')
    Users
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
                <li class="active">Users</li>
            </ol>
        </div><!--/.row-->
       <div class="row">
        <div class="col-sm-12">
            <br>
            <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user" ></span>  Add New User</a>
            <br>
        </div>
    </div>
        <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email Address</th>
        <th>Permission</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     @foreach($users as $user)
     <tr>
      @if($user->id != 1)
      <td>{{$user->id}}</td>
         <td>{{$user->username}}</td>
         <td>{{$user->email}}</td>
         <td>
           <select name="permission" class="permission" onchange="changePermission(this.value)">
             <option value="Administrator,{{$user->id}}" data="{{($user->permission_type=="Administrator")?$user->permission:'1'}}" {{($user->permission_type=="Administrator")?"selected":""}}>Administrator</option>
             <option value="Author,{{$user->id}}"  data="{{($user->permission_type=="Author")?$user->permission:'2'}}" {{($user->permission_type=="Author")?"selected":""}}>Author</option>
             <option value="User,{{$user->id}}" data="{{($user->permission_type=="User")?$user->permission:'3'}}" {{($user->permission_type=="User")?"selected":""}}>User</option>
           </select>
         </td>
        {{--  <td><span class="user_id" onblur ="updatePermission({{$user->id}})" data-value="{{$user->id}}" id="user{{$user->id}}" contentEditable="true" onclick = "this.contentEditable = true;" >{{$user->permission_type}}</span></td> --}}
         <td>
             @if($user->action=='1')
                    <input type="checkbox" name="action" id="" checked="" onclick="updateAction({{$user->id}},{{$user->action}})">
            @else
                <input type="checkbox" name="action" id="" onclick="updateAction({{$user->id}},{{$user->action}})">
            @endif
         </td>
      @endif

     </tr>
     @endforeach
    </tbody>
  </table>
  <div class="row">
      <div class="col-sm-12">
          {!! $users->render() !!}
      </div>
  </div>
 </div>
 <div class="form-user">
    <!-- Modal -->
    <form action="{{route('add_user')}}" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel text-danger"><div class="glyphicon glyphicon-user"></div> Add new User</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <div class="form-group">
                <input type="text" name="username" id="" class="form-control" placeholder="Username" required="required">
                <small class="text-danger">{{$errors->first('username')}}</small>
            </div>
            <div class="form-group">
                <input type="text" name="email" id="" class="form-control" placeholder="Email" required="required">
                 <small class="text-danger">{{$errors->first('email')}}</small>
            </div>
            <div class="form-group">
                <input type="password" name="password" required="required" id="" class="form-control" placeholder="Password">
                 <small class="text-danger">{{$errors->first('passoword')}}</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info" style="border-radius:0px;">Save</button>
          </div>
        </div>
      </div>
    </div>
    </form>
 </div>
@stop