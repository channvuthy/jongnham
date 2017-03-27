@extends('version2.layouts.master')
@section('title')
Jongnhams / {{$store->name}}
@stop
@section('content')
@include('version2.layouts.inc.headerlistview')
<div class="container">
   <div class="row">
      <div class="col-md-9 __clear__padding__left">
         <div class="__detail__preview">
            <div class="col-md-5 __clear__padding__left">
               <?php $imageArray=explode("||",$store->images);?>
               @if(empty($store->images))
             <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive">
               @else
               <img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive">
               @endif
               <br>
               <div class="col-md-12 review-preview-store">
                  <p>Your overall rating of this property</p>
                  <br>
                  <p><b>Your Review</b></p>
                  <div class="__box__rate">
                  <span class="btn btn-success btn-xs __clear__border pull-right __range"  style="cursor: default;">
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
                  <div class="basic" data-average="{{ceil($store->rating)}}" data-id="{{$store->id}}"></div>
                  
                  </div>
               </div>
            </div>
            <div class="col-md-7 __clear__padding-right">
               <h3 class="__clear__margin __title__preview__detail">{{$store->name}}</h3>
               <p>Rate 
               @php
               $star=$store->rating;
               $star=ceil($star);
               @endphp
               @foreach(range(1,5) as $rate)
               @if($rate <=$star)
               <i class="fa fa-star rated"></i>
               @else
               <i class="fa fa-star "></i>
               @endif
               @endforeach
               <span class="view">(view {{$store->view}})</span>
               </p>
               <p>{{$store->address}}</p>
            </div>
            <div class="col-md-12 __clear__padding-comment">
               <hr>
               @if(count($comment))
               @foreach($comment as $storeComment)
               <p id="editcomment">{{$storeComment->comment_body}}</p>
               <button type="button" class="btn btn-success btn-xs" id="buttonEdit" onclick="showEditReview('buttonEdit')">Edit your comment</button>
               <form action="{{route('store.updatecomment',array('storeID'=>$store->id,'userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}" method="post" id="formUpdate" >
                  <input type="hidden" name="_token" value="{{Session::token()}}">
                  <div class="form-group">
                     <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" placeholder="Summarize your visit or highlight an interesting detail"></textarea>
                  </div>
                  <div class="fom-group">
                     <button type="submit" class="btn btn-success btn-xs update">Update your comment</button>
                  </div>
               </form>
               @endforeach
               @else
               <form action="{{route('store.comment',array('storeID'=>$store->id,'userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}" method="post">
                  <input type="hidden" name="_token" value="{{Session::token()}}">
                  <div class="form-group">
                     <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" placeholder="Summarize your visit or highlight an interesting detail"></textarea>
                  </div>
                  <div class="fom-group">
                     <button type="submit" class="btn btn-success">Comment</button>
                  </div>
               </form>
               @endif
            </div>
         </div>
      </div>
      <div class="col-md-3 __clear__padding__right">
         <div class="__list__visited">
            <h3>History</h3>
            <br>
            @if(Auth::check())
            @php
            $userID=Auth::user()->id;
            @endphp
            @foreach(Auth::user()->histories as $history)
            @php
            $checkExists =(DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id={$history->id}"))?true:false;
            @endphp
            @if($checkExists==false)
            <div class="__box__review .__box__review-edit">
               <a href="{{route('store.reviewpreview',array('userID'=>Auth::user()->id,'id'=>$history->id,'key'=>bcrypt(Auth::user()->id)))}}">
               @if(empty($history->images))
              <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive">
               @else
               <img src="{{asset('uploads')}}/{{$history->images}}" alt="" class="img-responsive">
               @endif
               </a>
               <br>
               <b>{{$history->name}}</b>
               <br>
               @php
               $star=ceil($history->rating);
               @endphp
               <p>Rate
               @foreach(range(1,5) as $rate)
                  @if($rate<=$star)
                  <i class="fa fa-star rated"></i>
                  @else
                  <i class="fa fa-star"></i>
                  @endif
               @endforeach 
               <span>(View {{$history->view}})</span>
               </p>
               <p>{{$history->address}}</p>
            </div>
            @endif
            @endforeach
            @endif
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
         data:{comment:comment,storeID:{{$store->id}},userID:{{Auth::user()->id}} },
         success:function(data){
            window.location.reload(true);
            console.log(data);
         }
       });
   });
</script>
@stop