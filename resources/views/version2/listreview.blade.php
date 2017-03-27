@extends('version2.layouts.master')
@section('title')
Review
@stop
@section('content')
@include('version2.layouts.inc.headerlistview')
<div class="container">
   <div class="__search__review">
      <form action="{{route('search.store')}}" method="post">
         <input type="hidden" name="_token" value="{{Session::token()}}">
         <div class="__input__search">
            <div class="fa fa-search"></div>
            <input type="text" name="search" id="search" placeholder="Find Restaurant name...">
         </div>
         <div class="__button__search">
            <button type="submit">Find</button>
         </div>
      </form>
   </div>
   <div class="row">
      <div class="col-md-9 review-list">
         <h3 class="__review__title"><b>Place your reviewed before</b></h3>
         <br>
         @foreach(Auth::user()->reviewStore as $review)
            @foreach($review->comments as $comment)
            @if(Auth::user()->id ==$comment->user_id)
            <div class="__box__reviewed_">
               <div class="col-md-5 __clear__padding__left">
                  <div class="ImageHomePage img-review-list">
                  @if(empty($review->images))
                      <a href="{{route('getRestaurantDetail',array('name'=>$review->name,'id'=>$review->id))}}"><img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>
                  @else
                  <a href="{{route('getRestaurantDetail',array('name'=>$review->name,'id'=>$review->id))}}"><img src="{{asset('uploads')}}/{{$review->images}}" alt="" class="img-responsive"></a>
                  @endif
                  </div>
               </div>
               <div class="col-md-7">
                  <h3 style=""><b><a href="{{route('getRestaurantDetail',array('name'=>$review->name,'id'=>$review->id))}}">{{$review->name}}</a></b></h3>
                  <p><span style="color:#40af6b;">Rate</span>
                  @php
                  $star=$review->storeRating->avg('rating');
                  @endphp
                  @foreach(range(1,5) as $rate)
                     @if($rate<=$star)
                     <span class="fa fa-star rated"></span>

                     @else
                     <span class="fa fa-star"></span>
                     @endif
                  @endforeach
                  <span> (view {{$review->view}})</span></p>
                  <p class="__comments">
                     
                     @if(strlen($comment->comment_body) >60) {{substr($comment->comment_body,0,60)}} ... @else {{$comment->comment_body}} @endif
                    
                  </p>
                  <!--<b>{{$comment->comment_body}}</b>-->
                  <p class="__edit__comment">
                     <a href="{{route('store.reviewpreview',array('userID'=>Auth::user()->id,'id'=>$review->id,'key'=>bcrypt(Auth::user()->id)))}}" class="edit" style="color:#FF9800">Edit</a>
                  </p>
               </div>
            </div>
            
              @endif
               @endforeach
         @endforeach
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
            <div class="__box__review block-review-historylis">
              <div class="ImageHomePage img-review-historylist"><a href="{{route('store.reviewpreview',array('userID'=>Auth::user()->id,'id'=>$history->id,'key'=>bcrypt(Auth::user()->id)))}}">
            
             @if(empty($history->images))
             <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive">
             @else
              <img src="{{asset('uploads')}}/{{$history->images}}" alt="" class="img-responsive">
              
              @endif
              </a></div>
              <b>{{$history->name}}</b>
              @php
              $rating=$history->rating;
              $rating=ceil($rating);
              @endphp
              <p>Rate 
              @foreach(range(1,5) as $rate)
              @if($rate <=$rating)
              <i class="fa fa-star rated"></i>
              @else
              <i class="fa fa-star"></i>
              @endif
              @endforeach
              <span>(view {{$history->view}})</span>
              </p>
              <p>{{substr($history->address,0,40)}}...</p>
            </div>
            @endif
            @endforeach
            @endif
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(function() {
    $("#search").autocomplete({
        source: "{{route('search.review')}}",
        minLength: 1,
        select: function(event, ui) {
            $('search').val(ui.item.value);
        }
    });
    $('#search').data("ui-autocomplete")._renderItem = function(ul, item) {
        var $li = $("<li style='width:800px;margin-left:10px;margin-bottom:5px'>"),
            $img = $("<img style='width:8%'>");
        $img.attr({
            src: '{{asset("uploads")}}/' + item.avatar,
            alt: item.value
        });
        $li.attr('data-value', item.value);
        $li.append("");
        $li.append($img).append("" + item.value);
        return $li.appendTo(ul);

    };
});
</script>
@stop