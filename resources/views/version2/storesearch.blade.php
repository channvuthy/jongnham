@extends('version2.layouts.master')
@section('title')
   Search Result
@stop
@section('content')
@include('version2.layouts.inc.headerlistview')
@php
$storeID=$store->id;
@endphp
<div class="container">
   <div class="row">
      <div class="col-md-9 __clear__padding__left">
         <br>
         <div class="col-md-5 __clear__padding__left __comment-search-main">
            @php
            $imageArray=explode("||",$store->images);
            @endphp
            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
            <div class="col-md-12 __comment-search-rating">
                  <br>
                  <p>Your overall rating of this property</p>
                  <br>
                  <p><b>Your Review</b></p>
                  <div class="__box__rate">
                  <span class="btn btn-success btn-xs __clear__border pull-right __range" >
                     @if($store->rating<=1)
                     Terrible
                     @elseif($store->rating<=2)
                     Poor
                     @elseif($store->rating<=2)
                     Average
                     @elseif($store->rating<=2)
                     Very Good
                     @else
                     Excellent
                     @endif
                  </span>
                  <div class="basic" data-average="{{$store->rating}}" data-id="{{$store->id}}"></div>
                  
            </div>
            <br>
            </div>
               
         </div>
         <div class="__clear__padding__right col-md-7">
            <h3><b> <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</a></b></h3>
            @php
            $star=ceil($store->rating);
            @endphp
            <p><span style="color:#0ea749;">Rate</span>
               @foreach(range(1,5) as $rate)
               @if($rate<=$star)
               <span class="fa fa-star rated"></span>
               @else
               <span class="fa fa-star"></span>
               @endif
               @endforeach
               <span>(View {{$store->view}})</span>
            </p>
            <p>{{$store->address}}</p>
         </div>
         <div class="col-md-12 __comment-search">
            @php
            $userID=Auth::user()->id;
            $row= DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeID}");
            $numRow=count($row);
            @endphp
            @if($numRow ==0)
            <form action="">
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <div class="form-group">
                  <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" placeholder="Summarize your visit or highlight an interesting detail"></textarea>
               </div>
               <div class="fom-group">
                  <button type="submit" class="btn btn-success btncomment">Submit</button>
               </div>
            </form>
            @else
            <p id="editcomment">@foreach($row as $comment) {{$comment->comment_body}} @endforeach</p>
            <button type="button" class="btn btn-success btn-xs" id="buttonEdit" onclick="showEditReview('buttonEdit')">Edit your comment</button>
            <form action="#" id="formUpdate" >
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <div class="form-group">
                  <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" placeholder="Summarize your visit or highlight an interesting detail"></textarea>
               </div>
               <div class="fom-group">
                  <button type="submit" class="btn btn-success btn-xs update">Update your comment</button>
               </div>
            </form>
            @endif
         </div>
      </div>
      <div class="col-md-3 __clear__padding__right">
         <div class="__list__visited">
            <h3>Place Visited</h3>
            <br>
            @foreach(Auth::user()->histories as $store)
            @if(count($store->comments) <=0)
            <div class="__food__review">
               <?php $imageArray=explode("||",$store->images);?>
               <a href="{{route('store.reviewpreview',array('userID'=>Auth::user()->id,'id'=>$store->id,'key'=>bcrypt(Auth::user()->id)))}}"><img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive"></a>
               <div class="__review__description">
                  <h4>{{$store->name}}</h4>
                  <?php $stars=DB::select("SELECT stores.*,AVG(store__ratings.rating) AS average FROM stores INNER JOIN store__ratings ON stores.id=store__ratings.store_id WHERE stores.id=$store->id GROUP BY stores.id ORDER BY average DESC");?>
                  @foreach($stars as $star)
                  <?php $rate=ceil($star->average);?>
                  <p><b>Rate</b>
                     <?php foreach(range(1,5) as $rated):?>
                     @if($rated <= $rate)
                     <i class="fa fa-star rated"></i>
                     @else
                     <i class="fa fa-star "></i>
                     @endif
                     <?php endforeach;?>
                     <span class="view">(view {{$store->view}})</span>
                     @endforeach
                  <p>{{$store->address}}</p>
               </div>
            </div>
            @endif
            @endforeach
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $("#formUpdate").hide();
   function showEditReview(button){
      $("#formUpdate").show();
      var commenttext=$("#editcomment").text();
      $("#comment").val(commenttext);
      $("#"+button).hide();
      $("#editcomment").hide();
   
   }
   $(".update").click(function(e){
       e.preventDefault();
       var comment=$("#comment").val();
       jQuery.ajax({
         url:"{{route('search.update.comment')}}",
         type:"GET",
         data:{comment:comment,storeID:{{$storeID}},userID:{{Auth::user()->id}} },
         success:function(data){
            window.location.reload(true);
            console.log(data);
         }
       });
   });
   $(".btncomment").click(function(e){
      e.preventDefault();
      var comment=$("#comment").val();
      if(comment==""){
         alert("Please enter your comment");
      }
      jQuery.ajax({
         url:"{{route('search.comment')}}",
         type:"GET",
         data:{comment:comment,storeID:{{$storeID}},userID:{{Auth::user()->id}} },
         success:function(data){
            window.location.reload(true);
         }
      });
   });
</script>
@stop