 @section('content')
@extends('admin.master')
@section('title')
    Add Type of  Place
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
                <li class="active">Add Type of  Place</li>
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
           <form action="{{route('postSaveTypeofPlace')}}" method="post" id="addtypeofplace">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <div class="col-md-12">
                <ul class="list-inline">

                    <li><a href="{{route('addtypeofplace')}}" class="btn btn-danger btn-xs">Add Type of  Place</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
              <div class="form-group">
                  <label for="">Name of Place</label>
                  <input type="text" name="placename" id="" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="">Description</label>
                  <textarea name="description" id="" cols="30" rows="5" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
           </form>
        </div>
</div>
<script type="text/javascript">
    $( "#addtypeofplace" ).validate({
      rules: {
        name: {
          required: true
        },
         description: {
          required: true
        }
      }
    });
</script>
<style type="text/css">
    .error{
        color:red;
    }
</style>
@stop

