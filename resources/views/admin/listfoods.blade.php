 @section('content')
@extends('admin.master')
@section('title')
    List Foods 
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
                <li class="active">List Foods</li>
            </ol>
        </div><!--/.row-->
              <div class="row">
              <br>
             <div class="col-sm-12">
            @if($errors->has('message'))
                <div class="alert alert-success">
                    {{$errors->first('message')}}
                </div>
            @endif
        </div>
        </div>
            <div class="row">
            <form action="{{route('postList')}}" method="post" enctype="multipart/form-data">
            <br>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Food Name</label>
                        <small class="text-danger">{{$errors->first('name')}}</small>
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Price</label>
                        <small class="text-danger">{{$errors->first('price')}}</small>
                        <input type="text" name="price" id="" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                        <label for="">Store Name</label>
                        <select name="store_id" id="" class="form-control">
                            <?php
                                $stores=DB::table('stores')->where('user_id','=',Auth::user()->id)->get();
                            ?>
                            
                            @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Description</label>
                         <small class="text-danger">{{$errors->first('description')}}</small>
                        <textarea name="description" id="" cols="30" rows="10" class="my-editor"></textarea>
                        @include('admin.textarea')
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                            <input id="file-5" class="file" type="file" data-preview-file-type="any" data-upload-url="#" name="files[]" multiple="multiple">
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-info" style='border-radius:0px;'>Save</button>
                </div>
            </div>
            </form>
            <br>
            <br>
            @if(count($listAllFoods))
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Store</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listAllFoods as $listFood)
                            <tr>
                                <td>{{$listFood->id}}</td>
                                <td>{{$listFood->name}}</td>
                                <td>{{$listFood->price}}</td>
                                <td>
                                    
                                    <?php
                                        $st=App\Models\Store::find($listFood->store_id);
                                    ?>
                                    {{$st->name}}
                                </td>
                                <td><a href="{{route('getEditList',array($listFood->id))}}"><span class="glyphicon glyphicon-edit"></span></a> || <a href="{{route('deleteList',array($listFood->id))}}" onclick="return confirm('Do you want to delete this item?')"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                
            @endif
    </div>

@stop