 @section('content')
@extends('admin.master')
@section('title')
    Store Types
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
                <li class="active">Store Types</li>
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
            <div class="col-sm-6">
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                        @if(count($store__types))
                            @foreach($store__types as $store__type)
                                <tr>
                                    <td>{{$store__type->id}}</td>
                                    <td>{{$store__type->name}}</td>
                                    <td><div class="glyphicon glyphicon-pencil" onclick="editStoreType('{{$store__type->id}}','{{$store__type->name}}','{{$store__type->description}}')"></div> || <div class="glyphicon glyphicon-trash" onclick="deleteType('{{$store__type->id}}')"></div></td>
                                </tr>
                            @endforeach
                        @endif
                    </thead>
                </table>
            </div>
            <div class="col-sm-6">
            <br>
                <form action="{{route('postStoreType')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" name="name" id="" class="form-control">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-info" style='border-radius:0px;'>Save</button>
                    </div>
                </form>
            </div>
        </div>
</div>
@stop

<!--Modal-->
        <div class="modal fade" id="modal-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Update Store Type</h4>
                    </div>
                    <form action="{{route('postUpdateStoreType')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" id="nametype" class="form-control">
                            <input type="hidden" name="id" id="idtype">
                        </div>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" style='border-radius:0px;'>Update</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->