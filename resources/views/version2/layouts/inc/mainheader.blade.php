<div class="row margin__clear">
   <div class="col-md-12 padding__clear">
      <nav class="navbar navbar-default" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#"><img src="{{asset('uploads')}}/logo.png" alt="">
               </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right search__icon">
                  <li id="first__icon">
                     @if(Auth::check())
                     <a href="{{route('store.all.save')}}"><img src="{{asset('uploads')}}/save.png" alt=""><span>Saved</span></a>
                     @else
                     <a href="#" onclick="login__form()"><img src="{{asset('uploads')}}/save.png" alt=""><span>Saved</span></a>
                     @endif
                  </li>
                  <li>
                     @if(empty(\Auth::check()))
                     <a href="#" onclick="login__form();"><img src="{{asset('uploads')}}/review.png" alt=""><span>Review</span></a>
                     @else
                     <a href="{{route('store.getListReview',array('userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}"><img src="{{asset('uploads')}}/review.png" alt=""><span>Review</span></a>
                     @endif
                  </li>
                  <li>
                     @if(empty(\Auth::check()))
                     <a href="#" onclick="register__form();"><img src="{{asset('uploads')}}/user.png" alt=""><span>Sign Up</span></a>
                     @else
                     <a href="{{route('user.logout')}}"><img src="{{asset('uploads')}}/logout-24.png" alt=""><span>Logout</span></a>
                     @endif
                  </li>
                  <li>
                     @if(empty(\Auth::check()))
                     <a href="#" onclick="login__form();"><img src="{{asset('uploads')}}/login.png" alt=""><span>Login</span>
                     @else
                     <a href="{{route('getUserProfile')}}"><img src="{{asset('uploads')}}/user.png" alt=""><span>Account</span>
                     @endif
                     </a>
                  </li>
               </ul>
            </div>
      </nav>
      </div>
   </div>
</div>
<!-- header middle-->
<div class="container-fluid margin__clear padding__clear version2-mainheader jongbg__">
   <div class="row search__option padding__clear margin__clear">
      <div class="bg__option__search" id="bg__option__search">
         <h1 class="intersted">Any where to eat? This is where to search!</h1>
         {{--<img src="{{asset('uploads')}}/background.png" alt="" class="img-responsive">--}}
      </div>
      <div class="container">
         <div class="header__middle">
            <form method="get" enctype="multipart/form-data" action="{{route('search.globle')}}">
               <div class="box__search">
                  <div class="box__search__option">
                     <div class="component__search">
                        <input type="text" name="restaurantname" id="restaurantname" placeholder="   Search restuarant name">
                     </div>
                     <div class="component__search">
                        <input type="text" name="typeoffood" id="typeoffood" placeholder="Type of Food">
                     </div>
                     <div class="component__search">
                        <input type="text" name="location" id="location" placeholder="Near Location">
                     </div>
                     <div class="component__search">
                        <input type="text" name="place" id="place" placeholder="Place" >
                     </div>
                     <div class="component__search">
                        <button class="bt__search">Find</button>
                     </div>
                  </div>
                  <div class="box__search__description">
                     <div class="incon__search__description">
                        <p><img src="{{asset('uploads/fast.png')}}" alt=""> Easy to find place to eat</p>
                     </div>
                     <div class="incon__search__description">
                        <p><img src="{{asset('uploads/save-time.png')}}" alt=""> Save your favourite place</p>
                     </div>
                     <div class="incon__search__description">
                        <p><img src="{{asset('uploads/top-rate.png')}}" alt=""> Save time in finding place</p>
                     </div>
                  </div>
                  <!--Modal Search Type of Food-->
                  <div class="list-type-food" id="modals">
                     <div class="row">
                        @foreach($typeoffoods as $typeoffood)
                        <div class="col-md-4 col-sm-4 col-xs-12" style="border-left:1px solid #ccc;">
                           <p data="{{$typeoffood->name}}" class="valuefood">&raquo; {{$typeoffood->name}}</p>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                        <div class="closebutton btn btn-default btn-xs pull-right __clear__border" style="margin-right:10px;">Close</div>
                     </div>
                  </div>
                  <!-- /.modal -->
                  <!--End Modal Search Type of Food-->
                  <!--Modal Location -->
                  <div class="modalsLocation" id="modalsLocation">
                     <div class="row">
                        @php
                        $locations=App\Models\Location::all();
                        @endphp
                        @foreach($locations as $location)
                        <div class="col-md-4 col-sm-4 col-xs-12" style="border-left:1px solid #ccc;">
                           <p data="{{$location->name}}" class="valueLocation">&raquo; {{$location->name}}</p>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                        <div class="closebutton btn btn-default btn-xs pull-right __clear__border" style="margin-right:10px;">Close</div>
                     </div>
                  </div>
                  <!-- /.modal -->
                  <!--End Modal location-->
                  <!--Modal Place -->
                  <div class="modalsLocation" id="modalsPlace">
                     <div class="row">
                        @php
                        $places=App\Models\Typeofplace::all();
                        @endphp
                        @foreach($places as $place)
                        <div class="col-md-4 col-sm-4 col-xs-12" style="border-left:1px solid #ccc;">
                           <p data="{{$place->placename}}" class="valuePlace">&raquo; {{$place->placename}}</p>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                        <div class="closebutton btn btn-default btn-xs pull-right __clear__border" style="margin-right:10px;">Close</div>
                     </div>
                  </div>
                  <!-- /.modal -->
                  <!--End Modal Place-->
               </div>
               <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
         </div>
      </div>
   </div>
</div>
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
               <p>
                   
                   Thank you for registering! Please confirm your email address before you can login.
               </p>
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
<!--Script confirmation email-->
<?php if($errors->first('message')):?>
<script type="text/javascript">
   $(window).load(function(){
       $('.mymodal ').modal('show');
   });
</script>
<?php endif;?>
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
//           "top": "0" +  "px"
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
</script>
<script type="text/javascript">
   $(function() {
    $("#restaurantname").autocomplete({
        source: "{{route('search.review')}}",
        minLength: 1,
        select: function(event, ui) {
            $('restaurantname').val(ui.item.value);
        }
    });
    $('#restaurantname').data("ui-autocomplete")._renderItem = function(ul, item) {
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
   $("#typeoffood").click(function(){
     $(".list-type-food").show('slow');
     $("#modalsLocation").hide('slow');
     $("#modalsPlace").hide('slow');
   });
   $(".valuefood").click(function(){
        $("#typeoffood").val($(this).attr('data'));
        $(".list-type-food").hide('slow');
   });
   $("#location").click(function(){
    $("#modalsLocation").show('slow');
    $(".list-type-food").hide('slow');
     $("#modalsPlace").hide('slow');
     $(".list-type-food").hide('slow');
   });
   $(".valueLocation").click(function(){
    var sendData=$(this).attr('data');
    $("#location").val(sendData);
      jQuery.ajax({
          url:"{{route('update.distance')}}",
          type:"GET",
          data:{location:$(this).attr('data')},
          success:function(data){
            console.log(data);
          }
      });
    $(".valueLocation").removeClass('foodActive');
     $(this).addClass('foodActive');
     $("#modalsLocation").hide('slow');
   });
   
   $("#place").click(function(){
       $("#modalsPlace").show('slow');
       $("#modalsLocation").hide('slow');
       $(".list-type-food").hide('slow');
       $(".list-type-food").hide('slow');
   });
   $(".valuePlace").click(function(){
      $("#place").val($(this).attr('data'));
      $("#modalsPlace").hide('slow');
   });
   $(".closebutton ").click(function(){
      $(this).parent().parent().hide("slow");
   })
</script>
<style type="text/css">
   ..box__search:before {
   content: "";
   position: absolute;
   background-image: url(http://jongnhams.com/uploads/cheif.png);
   width: 244px;
   height: 378px;
   left: -136px;
   top: -175px;
   background-repeat: no-repeat;
   background-size: contain;
   }
   ..box__search:after {
   content: "";
   right: -146px;
   position: absolute;
   background-image: url(http://jongnhams.com/uploads/glass.png);
   height: 300px;
   width: 216px;
   top: -104px;
   background-size: contain;
   background-repeat: no-repeat;
   z-index: 1;
   }
   .jongbg__{
   background: url("{{asset('images/bgmain-header.png')}}") no-repeat center top;
       background-size: 1692px;
    background-color: #be2026;
   }
   @media screen and (max-width: 970px){
   .jongbg__{
		background:#be2026 !important;
	}
	.box__search {
	    background: #070909;
	    height: 170px;
	}
}
 @media screen and (max-width: 853px){
	.box__search {
	    background: #070909;
	    height: 300px;
	}
}
</style>