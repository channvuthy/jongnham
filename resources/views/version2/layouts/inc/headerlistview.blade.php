<div class="row margin__clear">
   <div class="col-md-12 padding__clear">
      <nav class="navbar navbar-default headerresturant" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="{{URL::to('/')}}/version2"><img src="{{asset('uploads')}}/logo.png" alt="">
               </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right search__icon">
                  <li id="first__icon">
                     <a href="{{route('store.all.save')}}"><img src="{{asset('uploads')}}/save.png" alt=""><span>Saved</span>
                     </a>
                  </li>
                  <li>
                     @if(empty(\Auth::check()))
                        <a href="#" onclick="login__form();"><img src="{{asset('uploads')}}/review.png" alt=""><span>Review</span></a>
                     @else
                        <a href="{{route('store.getListReview',array('userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}"><img src="{{asset('uploads')}}/review.png" alt=""><span>Review</span></a>
                     @endif
                  </li>
                  <li>
                     @if(!empty(\Auth::check()))
                     <a href="{{route('getUserProfile')}}"><img src="https://www.gravatar.com/avatar/{{md5(strtolower(trim(Auth::user()->email)))}}?d=mm" alt=""><span>{{Auth::user()->username}}</span></a>
                     @endif
                  </li>
               </ul>
            </div>
      </nav>
      </div>
   </div>
   <!--End header top-->
   <!--Start Header Search section-->
 <!-- header middle-->