 @section('content')
@extends('admin.master')
@section('title')
    Type of Food
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
                <li class="active">Type of Food</li>
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
            <div class="col-md-12">
                <ul class="list-inline">
                    <li><div class="glyphicon glyphicon-file"> Type of Food</div></li>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
               <form action="{{route('postaddtypeoffood')}}" method="post" enctype="multipart/form-data" id="addtypeoffood">
                   <input type="hidden" name="_token" value="{{Session::token()}}">
                   <div class="form-group">
                        <input type="text" name="name" id="" class="form-control" required  id="name">
                        <span class="error">{{$errors->first('name')}}</span>
                   </div>
                   <div class="form-group">
                       <textarea name="description" id="" cols="30" rows="5" class="form-control" required id="description"></textarea>
                   </div>
                   <div class="form-group">
                       <button type="submit" class="btn btn-info">Save </button>
                   </div>
               </form>
            </div>
        </div>
</div>
<script type="text/javascript">
	$( "#addtypeoffood" ).validate({
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

