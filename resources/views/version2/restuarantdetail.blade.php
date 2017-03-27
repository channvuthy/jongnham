@extends('version2.layouts.master')
@section('title')
{{$restuarantdetail->name}}
@stop
@section('content')
<div class="save">
@include('version2.layouts.inc.headerrestuarant')

</div>
<div class="container">
   <div class="row">
      <div class="col-md-9 __clear__padding">
         <h2>{{$restuarantdetail->name}}</h2>

      </div>
      <div class="col-md-3 saves">
         <br>
         <br>
         <ul class="list-inline">
            @if(empty(\Auth::check()))
            <li><a href="#" onclick="login__form();"><img src="{{asset('uploads')}}/save.png" alt=""> Save</a></li>
            @else
            <li>  
            @php
            $exists = DB::table('user__saves')
               ->wherestore_id($restuarantdetail->id)
               ->whereuser_id(Auth::user()->id)
               ->count() > 0;
            @endphp
            @if($exists)
              <a href="{{route('store.destory',array('userID'=>\Auth::user()->id,'storeID'=>$restuarantdetail->id,'key'=>bcrypt($restuarantdetail->name)))}}" class="saved"><img src="{{asset('uploads')}}/save.png" alt=""> Saved</a>
            @else
            <a href="{{route('store.save',array('userID'=>\Auth::user()->id,'storeID'=>$restuarantdetail->id,'key'=>bcrypt($restuarantdetail->name)))}}"><img src="{{asset('uploads')}}/save.png" alt=""> Save</a>
            @endif
            </li>
            @endif
            <li>
               @if(empty(\Auth::check()))
               <a href="#" onclick="login__form();"><img src="{{asset('uploads')}}/review.png" alt=""> Review</a>
               @else
               <a href="{{route('store.reviewpreview',array('userID'=>Auth::user()->id,'id'=>$restuarantdetail->id,'key'=>bcrypt(Auth::user()->id)))}}"><img src="{{asset('uploads')}}/review.png" alt=""> Review</a>

               @endif
            </li>
         </ul>
      </div>
      <p class="rate">
      <div class="basic" data-average="{{$restuarantdetail->rating}}" data-id="{{$restuarantdetail->id}}"></div>
      </p>
      <div class="col-md-9 __clear__padding__left">
         <?php $imageArray=explode("||",$restuarantdetail->images);?>
         @if(empty($restuarantdetail->images))
            <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive storeImage">
         @else
            <img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive storeImage">
         @endif
         <div class="__about__restuarant">
            <h2>About</h2>
            <div class="descrip-restarant" style="padding-left:0px;text-align: justify;">{!!$restuarantdetail->description!!}</div>
         </div>
         <div class="__recomment__menu">
            <h2>Recommended Menu</h2>
            @foreach($restuarantdetail->menufoods as $menu)
            <div class="col-md-4">
               <img src="{{asset('uploads')}}/{{$menu->image}}" alt="" class="img-responsive">
               <div class="des-recom__menu">
                  <p style="margin-top:8px;"><b>{{$menu->name}}</b></p>
                  <p style="color:darkorange;">{{$menu->price}}$</p>
               </div>
            </div>
            @endforeach
         </div>
         <div class="clearfix"></div>
         <div class="__box__comment">
           <ul class="list-inline">
              <li>Review</li>
           </ul>
           @if(Auth::check())
            @php
            $checkExist=App\Models\Comment::where('user_id',Auth::user()->id)->where('store_id',$restuarantdetail->id)->count();
            @endphp
              @if($checkExist!=1)
                  <div class="user">
                    @php
                            $userProfile=App\Models\User::select('email','username')
                           ->where('id', '=',Auth::user()->id)
                           ->first();
                    @endphp
                    <img src="https://www.gravatar.com/avatar/{{md5($userProfile->email)}}?s=40&d=mm">
                    <textarea name="comment" id="comment"  style="width:90%;" rows="2" placeholder="Your review here"></textarea>
                    <button class="btn btn-primary btn-xs __clear__border pull-right comment__system" data="{{$restuarantdetail->id}}">Comment</button>
                  </div>
              @endif
           @endif

           @foreach($restuarantdetail->comments as $comment)
              <div class="user">
                @php
                  $userProfile=App\Models\User::select('email','username')
                           ->where('id', '=',$comment->user_id)
                           ->first();
                @endphp
                <img src="https://www.gravatar.com/avatar/{{md5($userProfile->email)}}?s=40&d=mm">
               <span>{{$userProfile->username}}</span>
               <p>{{$comment->comment_body}}</p>
              </div>
           @endforeach
           @php

           @endphp
           
         </div>
         <div class="working__day">
           <h3><b><span class="fa fa-calendar"></span> Working Day</b></h3>
            <?php
         $businnesshour=$restuarantdetail->businnesshour;
         $hours = eval("return {$businnesshour};");
         
         $exceptions = array(
            '2/24'  => array('11:00-18:00'),
            '10/18' => array('11:00-16:00', '18:00-20:30')
        );

        // OPTIONAL
        // Place HTML for output below. This is what will show in the browser.
        // Use {%hours%} shortcode to add dynamic times to your open or closed message.
        $template = array(
            'open'           => "Yes, we're open! Today's hours are {%hours%}.",
            'closed'         => "Sorry, we're closed. Today's hours are {%hours%}.",
            'closed_all_day' => "Sorry, we're closed today.",
            'separator'      => " - ",
            'join'           => " and ",
            'format'         => "g:ia", // options listed here: http://php.net/manual/en/function.date.php
            'hours'          => "{%open%}{%separator%}{%closed%}"
        );
        $working=new \App\Working\WorkingClass($hours,$exceptions,$template);
      echo "<br/>";
        echo '<table class="table table-bordered">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Day</th>";
        echo "<th>Working Hour</th>";
        echo "</tr>";
        echo"</thead>";
    foreach ($working->hours_this_week() as $days => $hours) {
        echo '<tr>';
        echo '<td>' . $days . '</td>';
        echo '<td>' . $hours . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    // Same list, but group days with identical hours
    // echo '<table>';
    // foreach ($working->hours_this_week(true) as $days => $hours) {
    //     echo '<tr>';
    //     echo '<td>' . $days . '</td>';
    //     echo '<td>' . $hours . '</td>';
    //     echo '</tr>';
    // }
    // echo '</table>';
         ?>
         </div>
      </div>
      <div class="col-md-3 side-restarant" style="padding-right:0px;">
         <div class="__restuarant__information">
            <h3>Restuarant Information</h3>
            <ul class="list-unstyled">
               <li><i class="fa fa-phone"></i> {{$restuarantdetail->phone}}</li>
               <li><i class="fa fa-usd"></i> {{$restuarantdetail->pricefrom}}$ - {{$restuarantdetail->priceto}}$</li>
               <li><i class="fa fa-envelope-o"></i> {{$restuarantdetail->email}}</li>
               <li><i class="fa fa-firefox"></i> {{$restuarantdetail->website}}</li>
               <li><i class="fa fa-clock-o"></i> 
                  <?php
         $businnesshour=$restuarantdetail->businnesshour;
         $hours = eval("return {$businnesshour};");
         
         $exceptions = array(
            '2/24'  => array('11:00-18:00'),
            '10/18' => array('11:00-16:00', '18:00-20:30')
        );

        // OPTIONAL
        // Place HTML for output below. This is what will show in the browser.
        // Use {%hours%} shortcode to add dynamic times to your open or closed message.
        $template = array(
            'open'           => "Yes, we're open! Today's hours are {%hours%}.",
            'closed'         => "Sorry, we're closed. Today's hours are {%hours%}.",
            'closed_all_day' => "Sorry, we're closed today.",
            'separator'      => " - ",
            'join'           => " and ",
            'format'         => "g:ia", // options listed here: http://php.net/manual/en/function.date.php
            'hours'          => "{%open%}{%separator%}{%closed%}"
        );
        $working=new \App\Working\WorkingClass($hours,$exceptions,$template);
        echo $working->render();
         ?>
               </li>
            </ul>

         </div>
         <div class="__google__map">
            <div id="map" style="height:300px;"></div>
            <script>
               function initMap() {
                 var myLatLng = {lat: {{$restuarantdetail->maplat}}, lng:{{$restuarantdetail->maplon}}};
               
                 var map = new google.maps.Map(document.getElementById('map'), {
                   zoom: 15,
                   center: myLatLng
                 });
               
                 var marker = new google.maps.Marker({
                   position: myLatLng,
                   map: map,
                   title: 'Hello World!'
                 });
               }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB301j39-PCrbDTVZhn95hif4AB7JG5K_Q&callback=initMap"></script>
         </div>
         <div class="__recommended__store">
            <h3>Recommend</h3>
            @foreach($recommendeds as $recommended)
            <div class="__box__recommend block-homepage-pop">
               <?php $imageArray=explode("||", $recommended->images);?>
               @if(empty($recommended->images))
                                    <a href="{{route('getRestaurantDetail',array('name'=>$recommended->name,'id'=>$recommended->id))}}"><img src="{{asset('uploads/')}}/default-jongnham.jpg" alt="" class="img-responsive"></a>

               @else
               <a href="{{route('getRestaurantDetail',array('name'=>$recommended->name,'id'=>$recommended->id))}}"><img src="{{asset('uploads/').'/'.$imageArray[0]}}" alt="" class="img-responsive"></a>
               @endif
               
               <b>{{$recommended->name}}</b>
               <p class="rate">Rate 
                  <?php $star=$recommended->rating; ?>
                  @foreach(range(1,5) as $rate)
                  @if($rate<=$star)
                  <i class="fa fa-star rated"></i>
                  @else
                  <span class="fa fa-star"></span>
                  @endif
                  @endforeach
                  <span class="view">(view {{$recommended->view}})</span>
                  <span style="margin-top:10px;display: block;">{{$recommended->address}}</span>
               </p>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
    jQuery.ajax({
      url:"{{route('store.view')}}",
      type:"GET",
      data:{id:{{$_GET['id']}},click:1 },
      success:function(data){
        console.log(data);
      },
      error:function(){
                console.log(data);
      }
    });
   })
</script>
<!--Modal Register-->
<div class="modal modal__register fade __clear__border" id="modal-1">
   <div class="modal-dialog __clear__border" role="document">
      <div class="modal-content __clear__border">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title text-center">Register an Account</h4>
         </div>
         <div class="modal-body">
            <form action="{{route('user.register')}}" id="register_" method="post">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <input type="text" placeholder="Email Address" id="email" name="email" class="form-control" required >
                        <span class="text-danger">{{$errors->first('email')}}</span>
                     </div>
                     <div class="form-group">
                        <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                        <span class="text-danger">{{$errors->first('password')}}</span>
                     </div>
                     <div class="form-group">
                        <input type="password" placeholder="Confirm Password"  id="cpassword" name="cpassword" class="form-control" required>
                        <span class="text-danger" >{{$errors->first('cpassword')}}</span>
                     </div>
                     <div class="form-group text-center">
                        <button class="btn btn-danger  __clear__border" id="__botton__register" type="submit">Register</button>
                     </div>
                  </div>
               </div>
            </form>
            <div class="row">
               <div class="col-md-12">
                  <div class="__or text-center">OR</div>
                  <p class="text-center">Continue with Social Account</p>
                  <div class="__facebook__social">
                     <span class="fa fa-facebook"></span><a href="{{route('facebook.login')}}">Facebook</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer text-center">
            <p class="text-center">Already a meber? <a href="#" class="alreadyaccount">Sign In</a>
            </p>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--/.Modal Success-->
<div class="modal mymodal fade __clear__border" id="modal-container-930929" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog __clear__border">
      <div class="modal-content __clear__border">
         <div class="modal-body __clear__border">
            <div class="alert alert-success __clear__border">
               <p>Please confirm your email address. Thank you for register!!!</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!--End modal confirmation-->
<!--Modal Login-->
<div class="modal modal__login fade __clear__border" id="modal-1">
   <div class="modal-dialog __clear__border" role="document">
      <div class="modal-content __clear__border">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title text-center">Login to your  account</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <p class="text-center">Continue with Social Account</p>
                  <div class="__facebook__social">
                     <span class="fa fa-facebook"></span><a href="{{route('facebook.login')}}">Facebook</a>
                  </div>
                  <div class="__or text-center">OR</div>
                  <p class="text-center">Login with your email address</p>
               </div>
            </div>
            <form action="{{route('user.login')}}" id="login_" method="post">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <input type="text" placeholder="Email Address" id="email" name="email" class="form-control" required >
                        <span class="text-danger">{{$errors->first('message__error')}}</span>
                     </div>
                     <div class="form-group">
                        <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                     </div>
                     <div class="form-group text-center">
                        <button class="btn btn-danger  __clear__border" id="__botton__register" type="submit">Login</button>
                     </div>
                     <div class="form-group">
                        <p class="text-center">Not yet Account?<a href="#" class="registeraccount"> Register Now</a></p>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!--End Modal Login-->
<?php if($errors->first('email')):?>
<script type="text/javascript">
   $(window).load(function(){
       $('.modal__register ').modal('show');
   });
</script>
<?php endif;?>
@if($errors->first('message__error'))
<script type="text/javascript">
   $(".modal__login").modal('show');
</script>
@endif
<!--End Script confirmation email-->
<script>
   var myImage = new Image();
   myImage.onload = function() {
       var position__box__search = this.height / 2;
       $(".box__search").css({
           "top": "-" + position__box__search + "px"
       });
   
   }
   myImage.src = $('.bg__option__search img').attr('src');
   $(".search__icon  #first__icon,.search__icon  #first__icon img, .search__icon span").hover(function() {
       $(".search__icon  #first__icon img").attr("src", "{{asset('uploads')}}/save-hover.png");
   }).mouseout(function() {
       $(".search__icon  #first__icon img").attr("src", "{{asset('uploads')}}/save.png");
   });
   
   function register__form() {
       $(".modal__register").modal();
   }
   function login__form() {
       $(".modal__login").modal();
   }
   $("#register_").validate({
    rules: {
     email: {
       required: true,
       email: true
     },
     password: "required",
      cpassword: {
      equalTo: "#password"
     }
   }
   });
   $("#login_").validate({
    rules: {
     email: {
       required: true,
       email: true
     },
     password: "required",
   }
   });
   $(".alreadyaccount").click(function(e){
        e.preventDefault();
        $(".modal__register").modal('hide');
        $(".modal__login").modal();
   });
   $(".registeraccount").click(function(e){
        e.preventDefault();
        $(".modal__register").modal('show');
        $(".modal__login").modal('hide');
   });
   @if(Auth::check())
   $(".comment__system").click(function(){
    var comment=$("#comment").val();
    var resID=$(this).attr('data');
        jQuery.ajax({
            url:"{{route('user.review')}}",
            type:"GET",
            data:{storID:resID,comment:comment,userID:{{Auth::user()->id}} },
            success:function(data){
               window.location.reload();
            }
        });
   });
   @endif
</script>
@stop
