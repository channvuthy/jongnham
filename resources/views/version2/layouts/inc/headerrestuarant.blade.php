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
                  @if(!empty(\Auth::check()))
                     <a href="{{route('store.all.save')}}"><img src="{{asset('uploads')}}/save.png" alt=""><span>Saved</span>
                     @else
                        <a href="#" onclick="login__form()"><img src="{{asset('uploads')}}/save.png" alt=""><span>Saved</span>
                     @endif
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
                        <a href="{{route('user.logout')}}" ><img src="{{asset('uploads')}}/logout-24.png" alt=""><span>Logout</span></a>
                     @else
                        <a href="#" onclick="register__form();"><img src="{{asset('uploads')}}/user.png" alt=""><span>Sign Up</span></a>
                     @endif
                     
                  </li>
                  <li>
                     @if(!empty(\Auth::check()))
                     <a href="{{route('getUserProfile')}}"><img src="{{asset('uploads')}}/user.png" alt=""><span>Account</span></a>
                     @else
                        <a href="#" onclick="login__form();"><img src="{{asset('uploads')}}/login.png" alt=""><span>Login</span></a>
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
<div class="container-fluid margin__clear padding__clear" style="clear:both;min-height: 120px;">
   <div class="row search__option padding__clear margin__clear">
      <div class="container">
         <div class="header__middle">
            <form method="get" enctype="multipart/form-data" action="{{route('search.globle')}}">
            <div class="box__search" style="top:auto;width:100%;margin-left:auto;background-color: transparent;padding:0px;padding-top:50px;">
               <div class="box__search__option" style="box-shadow: 0px 0px 2px 1px #a59b9b;">
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
                     <input type="text" name="place" id="place" placeholder="Place">
                  </div>
                  <div class="component__search">
                     <button class="bt__search" style="background: #3ac917;">Find</button>
                  </div>
               {{-- Start box type of food  --}}
                  <div class="__box__type__of__food">
                        @php
                              $type_of_food=App\Models\Typeoffood::all();
                        @endphp
                        <div class="row">
                           @foreach($type_of_food as $food)
                           <div class="col-md-4 text-left" style="border-left:1px solid #ccc">
                              <p data="{{$food->name}}" class="valuefoodtypeoffood">» {{$food->name}}</p>
                           </div>
                           @endforeach
                           <div class="clearfix"></div>
                           <div class="col-md-12 ">
                              <button class="btn btn-default btn-xs pull-right __clear__border cancel__type__of__food" type="button"> Cancel </button>

                           </div>
                        </div>
                   </div>
                   {{-- End type of food --}}
                   {{-- Start box location --}}
                   <div class="__box__location">
                      @php
                        $locations =App\Models\Location::all();
                      @endphp
                      <div class="row">
                            @foreach($locations as $location)
                                 <div class="col-md-4 text-left" style="border-left:1px solid #ccc">
                                    <p class="valuelocation" data="{{$location->name}}">» {{$location->name}}</p>
                                 </div>
                            @endforeach
                            <div class="clearfix"></div>
                            <div class="col-md-12 ">
                              <button class="btn btn-default btn-xs pull-right __clear__border cancel__location"  type="button"> Cancel </button>

                           </div>
                      </div>
                      
                   </div>
                   {{-- End box location --}}
                   {{-- Start box place --}}
                     <div class="__box__place">
                        @php
                        $places=App\Models\Typeofplace::all();
                        @endphp
                        @foreach($places as $place)
                           <div class="col-md-4 text-left" style="border-left:1px solid #ccc">
                              <p class="valueplace" dataplace="{{$place->placename}}">» {{$place->placename}}</p> 
                           </div>
                        @endforeach
                        <div class="clearfix"></div>
                        <div class="col-md-12 ">
                              <button class="btn btn-default btn-xs pull-right __clear__border cancel__place" type="button"> Cancel </button>

                           </div>
                     </div>
                   {{-- End box place --}}
               </div>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
         </div>
      </div>
   </div>
</div>
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
      $(".__box__type__of__food").show('slow');
      $(".__box__place").hide('slow');
      $(".__box__location").hide('slow');
   });
   $(".valuefoodtypeoffood ").click(function(){
      $(".valuefoodtypeoffood ").removeClass('active');
      $(this).addClass('active');
      $("#typeoffood").val($(this).attr('data'));
      $(".__box__type__of__food").hide('slow');
   });
   $(".select__type__of__food").click(function(){
      var value_of_food=$(".active").attr('data');
      if(value_of_food==undefined){
         alert("Plase choose type of food");
      }else{
         $("#typeoffood").val(value_of_food);
         $(".__box__type__of__food").hide('slow');
      }
   });
   $(".cancel__type__of__food").click(function(){
      $(".__box__type__of__food").hide('slow');
   });
   $("#location").click(function(){
      $(".__box__location").show('slow');
       $(".__box__type__of__food").hide('slow');
      $(".__box__place").hide('slow');
   });
   $(".cancel__location").click(function(){
      $(".__box__location").hide("slow");
   });
   $(".valuelocation").click(function(){
      $(".valuelocation").removeClass("active").removeClass('locationData');
      $(this).addClass('active').addClass('locationData');
      $("#location").val($(this).attr('data'));
      $(".__box__location").hide('slow');
   });
   $(".select__location").click(function(){
      var value_of_location=$(".locationData").attr('data');
     $("#location").val(value_of_location);
     $(".__box__location").hide("slow");

   });
   $("#place").click(function(){
       $(".__box__place").show('slow');
       $(".__box__location").hide('slow');
       $(".__box__type__of__food").hide('slow');
   });
   $(".valueplace").click(function(){
      $(".valueplace").removeClass('active').removeClass('placeData');
      $(this).addClass('placeData').addClass('active');
      $("#place").val($(this).attr('dataplace'));
      $(".__box__place").hide('slow');
   });
   $(".select__place").click(function(){
      var place=$('.placeData').attr('dataplace');
      if(place==undefined){
         alert("Please select place");
      }else{
         $("#place").val(place);
         $(".__box__place").hide('slow');
      }
   });
   $(".cancel__place").click(function(){
         $(".__box__place").hide('slow');
   });
</script>
