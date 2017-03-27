<header>
   <!--Start Header Middlle-->
   <div class="header_middle">
      <div class="container hidden-xs hidden-sm">
         <div class="col-sm-2">
            <div class="logo">
               <a href="{{route('home')}}"><img src="{{asset('uploads')}}/logo.png" alt=""></a>
            </div>
         </div>
         <div class="col-md-8 col-sm-6">
            <!--Start Form Search-->
            <form action="{{route('search')}}" class="form_search" method="post">
               <div class="forms">
                  <div class="form-group">
                     <div class="box_search">
                        <div class="input-group group-search">
                           <input type="hidden" name="_token" value="{{Session::token()}}">
                           <input type="text" class="form-control" id="q-search" placeholder="Search ..." name="search">
                           <div class="input-group-addon addon-custom"><button type="submit" style='background-color:transparent;border:0px;padding:0px;margin:0px;'><span class="glyphicon glyphicon-search"  ></span></button></div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <!--End Form Search-->
         </div>
         <div class="col-sm-2 text-right">
            <div class="category">
               <a href="{{route('Categories')}}"> <img src="{{asset('uploads')}}/caticonred.png" alt=""></a>
            </div>
         </div>
      </div>
      <div class="menu_responsive hidden-md hidden-lg responsive_logo">
         <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-6">
               <div class="clearfix top-buffer"></div>
               <br>
               <a href="{{route('home')}}"><img src="{{asset('uploads')}}/logo.png" alt="" class="img-respn"></a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
               <div class="category" style="margin-top:35px;">
                  <a href="{{route('Categories')}}"> <img src="{{asset('uploads')}}/category.png" alt="" ></a>
                  <br>
                  <br>
               </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
               <form action="{{route('search')}}" class="form_search" method="post">
                  <div class="forms">
                     <div class="form-group">
                        <div class="box_search">
                           <div class="input-group group-search">
                              <input type="hidden" name="_token" value="{{Session::token()}}">
                              <input type="text" class="form-control" id="q-search" placeholder="Search ..." name="search">
                              <div class="input-group-addon addon-custom"><button type="submit" style='background-color:transparent;border:0px;padding:0px;margin:0px;'><span class="glyphicon glyphicon-search"  ></span></button></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--End Header Middlle-->
   <!--Start  Header Boittom-->
   <div class="header_bottom hidden-xs">
      <div class="carousel slide" id="carousel-20145">
      <ol class="carousel-indicators">
					<li data-slide-to="0" data-target="#carousel-20145">
					</li>
					<li data-slide-to="1" data-target="#carousel-20145" class="active">
					</li>
					<li data-slide-to="2" data-target="#carousel-20145">
					</li>
				</ol>
         <div class="carousel-inner">
           @foreach($sliders as $slider)
               @if($slider->id=="6")
                  <div class="item active">
                     {!!$slider->description!!}
                  </div>
               @else
                  <div class="item">
                     {!!$slider->description!!}
                  </div>
               @endif
           @endforeach
         </div>
    
      </div>
   </div>
   <!--En d Header Bottom-->
</header>