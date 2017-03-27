<div class="row margin__clear">
   <div class="col-md-12 padding__clear">
      <nav class="navbar navbar-default" role="navigation">
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
                     <a href="{{route('store.getListReview',array('userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}"><img src="{{asset('uploads')}}/review.png" alt=""><span>Review</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{route('user.logout')}}" ><img src="{{asset('uploads')}}/login.png" alt=""><span>Logout</span>
                     </a>
                  </li>
               </ul>
            </div>
      </nav>
      </div>
   </div>
</div>
<!-- header middle-->
<div class="container">
   <div class="row margin__clear">
      <div class="col-md-3 col-sm-3 col-xs-3 __clear__padding profile-rsp__">
         <div class="__user__left__sidebar">
            @if(Auth::user()->photo=="")
            <div class="__profile">
               <img src="{{asset('uploads/gravatar.gif')}}" alt="" class="__user__profile">
               <h4>{{Auth::user()->username}}</h4>
               <a href="http://jongnhams.com/user/account?change-image={{Auth::user()->id}}">Change Picture</a>
            </div>
            @else
            @if(Auth::user()->account_type=="1")
            <div class="__profile">
               <img src="{{Auth::user()->photo}}" alt="" class="__user__profile">
               <h4>{{Auth::user()->username}}</h4>
               <a href="http://jongnhams.com/user/account?change-image={{Auth::user()->id}}">Change Picture</a>
            </div>
            @else
            <div class="__profile">
               <img src="{{asset('uploads')}}/{{Auth::user()->photo}}" alt="" class="__user__profile">
               <h4>{{Auth::user()->username}}</h4>
               <a href="http://jongnhams.com/user/account?change-image={{Auth::user()->id}}">Change Picture</a>
            </div>
            @endif
            @endif
            <div class="__user__action">
               <a href="{{route('store.all.save')}}"><span class="badge">{{count(\Auth::user()->saveStore)}}</span> Saved</a>
               <a href="{{route('store.getListReview',array('userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}"><span class="badge">{{count(\Auth::user()->reviewStore)}}</span> Review</a>
            </div>
            <div class="__menu__user_left__sidbar">
               <ul class="list-unstyled">
                  <li class="<?php if(isset($_GET['edit-profile'])): echo 'active'; endif;?>"><a href="{{URL::to('/')}}/user/account?edit-profile=active&token={{bcrypt(Auth::user()->id)}}"><i class="fa fa-user" ></i> Edit Profile</a></li>
                  <li class="<?php if(isset($_GET['create-page'])): echo 'active'; endif;?>"><a href="{{URL::to('/')}}/user/account?create-page=active&token={{bcrypt(Auth::user()->id)}}"><i class="fa fa-building"></i> Create Restaurant</a></li>
                  <li class="<?php if(isset($_GET['list-store'])): echo 'active'; endif;?>"><a href="{{URL::to('/')}}/user/account?list-store=active&token={{bcrypt(Auth::user()->id)}}"><i class="fa fa-list"></i> Your Restaurant</a></li>
                  <li class="<?php if(isset($_GET['post'])): echo 'active'; endif;?>"><a href="{{URL::to('/')}}/user/account?post=active&token={{bcrypt(Auth::user()->id)}}"><i class="fa fa-tags"></i> Post to Restaurant</a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-md-9 col-xs-9 col-sm-9 saved-profile__">
         @if(Session::has('message'))
         <br>
         <br>
         <div class="alert alert-success __clear__border">
            {{Session::get('message')}}
         </div>
         @endif
         <div class="__arear__user">
            <?php if(isset($_GET['post'])):?>
            <form action="{{route('postSaveFood')}}" id="__posts" method="post" enctype="multipart/form-data">
               <h3><i class="glyphicon glyphicon-apple"></i>Post to Page</h3>
               <hr>
               <b>Select Page</b>
               <h2></h2>
               <?php $user=\App\Models\User::find(Auth::user()->id);?>
               <div class="form-group">
                  <select name="selectpage" id="" class="form-control">
                     @foreach($user->stores as $store)
                     @if($store->approval=="1" && $store->status==1)
                     <option value="{{$store->id}}">{{$store->name}}</option>
                     @endif
                     @endforeach
                  </select>
               </div>
               <div class="panel panel-primary">
                  <div class="panel-heading"> Add Food to Resturant </div>
                  <div class="panel-body">
                     <div class="form-group" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <label for="">Food Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="photo" id="file" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" name="price" id="price" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description" cols="30" rows="7" class="form-control" required></textarea>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="__post__btn">Save Food</button>
                     </div>
                  </div>
               </div>
            </form>
            <?php endif?>
            <?php if(isset($_GET['key'])):?>
            <h3>Edit Page</h3>
            <hr>
            <form class="form-horizontal __form__user"  style="font-size:12px;" action="{{route('postUpdateStoreUser')}}" method="post" enctype="multipart/form-data" id="__form__user">
               <div class="col-md-6 __clear__padding">
                  <input type="hidden" name="id" value="{{$store->id}}" >
                  {{ csrf_field() }}
                  <div class="form-group">
                     <h3 style="margin-left:12px;">General Information</h3>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Restaurant  Name*</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name" required value="{{$store->name}}">
                     </div>
                  </div>
                  @if($store->images)
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-12">Photo</label>
                     <div class="box__gallery col-sm-11" style="margin-left:4%; border:1px solid #ccc;">
                        @php
                        $imageArray=explode("||",$store->images);
                        @endphp
                        @if(count($imageArray)>=1)
                        @foreach($imageArray as $key => $image)
                        <div class="each__image" style="width:100px;margin:10px;float:left;position:relative;">
                           <i style="font-weight: bold;" dataid="{{$store->id}}" datakey="{{$key}}" class="delete" dataimage="{{$image}}">X</i>
                           <img src="{{asset('uploads')}}/{{$image}}" alt="" class="img-responsive" >
                        </div>
                        @endforeach
                        @else
                        @endif
                     </div>
                  </div>
                  @else
                  <div class="form-group" onclick="myDropZone();">
                     <label for="inputEmail3" class="col-sm-4">Profile photo</label>
                     <div class="col-sm-8">
                        <div class="form-control">
                           <img src="{{asset('uploads/1478868224_instagram_online_social_media.png')}}" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="border:1px solid #ccc;">
                     <div class="box__image form-group">
                        @for($i=0;$i<3;$i++)
                        <div class="thumbnail" style="width:112px;height:100px;border:1px solid #ccc;float:left;margin:12px;box-sizing:border-box;"></div>
                        @endfor
                     </div>
                  </div>
                  <div class="clearfix" style="margin-bottom:30px;"></div>
                  @endif
                  <div class="clearfix" style="margin-bottom:20px;"></div>
                  <div class="form-group">
                     <div class="col-md-12">
                        <button class="btn btn-primary  btn-block" type="button" onclick="businnesshour()"> <i class="fa fa-calendar" aria-hidden=""></i> Businnese hour</button>
                     </div>
                     <input type="hidden" name="buz" id="buz">
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Email</label>
                     <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" required value="{{$store->email}}" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Address*</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" name="address" required  value="{{$store->address}}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Phone Number*</label>
                     <div class="col-sm-8">
                        <input type="number" class="form-control" id="phone" name="phone" required value="{{$store->phone}}" min="1">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Website</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="website" name="website"  value="{{$store->website}}">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-12">Google map</label>
                     <div class="col-sm-12 col-md-12">
                        <style>
                           html, body {
                           height: 100%;
                           margin: 0;
                           padding: 0;
                           }
                           #map {
                           max-width:100%;
                           height: 400px;
                           }
                           #searchInput {
                           background-color: #fff;
                           font-family: Roboto;
                           font-size: 15px;
                           font-weight: 300;
                           margin-left: 12px;
                           padding: 0 11px 0 13px;
                           text-overflow: ellipsis;
                           width: 50%;
                           }
                           #searchInput:focus {
                           border-color: #4d90fe;
                           }
                        </style>
                        </head>
                        <body>
                           <input id="searchInput" class="controls" type="text" placeholder="Enter a location">
                           <div id="map"></div>
                           <ul id="geoData">
                              <input type="hidden" id="location" name="maplocation" >
                              <input type="hidden" id="postal_code" name="mappostal_code">
                              <input type="hidden" id="country" name="mapcountry">
                              <input type="hidden" id="lat" name="maplat" value="{{$store->maplat}}" >
                              <input type="hidden" id="lon" name="maplon" value="{{$store->maplon}}">
                           </ul>
                           <script>
                              function initMap() {
                                  var map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: {{$store->maplat}}, lng: {{$store->maplon}} },
                                    zoom: 13
                                  });
                                  var input = document.getElementById('searchInput');
                                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                              
                                  var autocomplete = new google.maps.places.Autocomplete(input);
                                  autocomplete.bindTo('bounds', map);
                              
                                  var infowindow = new google.maps.InfoWindow();
                                  var geocoder = new google.maps.Geocoder();
                                  var marker = new google.maps.Marker({
                                      map: map,
                                      position:{lat: {{$store->maplat}}, lng: {{$store->maplon}} },
                                      anchorPoint: new google.maps.Point(0, -29)
                                  });
                              
                                  autocomplete.addListener('place_changed', function() {
                                      infowindow.close();
                                      marker.setVisible(false);
                                      var place = autocomplete.getPlace();
                                      if (!place.geometry) {
                                          window.alert("Autocomplete's returned place contains no geometry");
                                          return;
                                      }
                                
                                      // If the place has a geometry, then present it on a map.
                                      if (place.geometry.viewport) {
                                          map.fitBounds(place.geometry.viewport);
                                      } else {
                                          map.setCenter(place.geometry.location);
                                          map.setZoom(17);
                                      }
                                      marker.setIcon(({
                                          url: place.icon,
                                          size: new google.maps.Size(71, 71),
                                          origin: new google.maps.Point(0, 0),
                                          anchor: new google.maps.Point(17, 34),
                                          scaledSize: new google.maps.Size(35, 35)
                                      }));
                                      marker.setPosition(place.geometry.location);
                                      marker.setVisible(true);
                                  
                                      var address = '';
                                      if (place.address_components) {
                                          address = [
                                            (place.address_components[0] && place.address_components[0].short_name || ''),
                                            (place.address_components[1] && place.address_components[1].short_name || ''),
                                            (place.address_components[2] && place.address_components[2].short_name || '')
                                          ].join(' ');
                                      }
                                  
                                      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                                      infowindow.open(map, marker);
                                    
                                      //Location details
                                      for (var i = 0; i < place.address_components.length; i++) {
                                          if(place.address_components[i].types[0] == 'postal_code'){
                                              document.getElementById('postal_code').value = place.address_components[i].long_name;
                                          }
                                          if(place.address_components[i].types[0] == 'country'){
                                              document.getElementById('country').value = place.address_components[i].long_name;
                                          }
                                      }
                                      document.getElementById('location').value = place.formatted_address;
                                      document.getElementById('lat').value = place.geometry.location.lat();
                                      document.getElementById('lon').value = place.geometry.location.lng();
                                  });
                                  google.maps.event.addListener(map, 'click', function (e) {
                                      document.getElementById('lat').value = e.latLng.lat();
                                      document.getElementById('lon').value = e.latLng.lng();  
                                      var marker = new google.maps.Marker({
                                        map: map,
                                        draggable: true,
                                        animation: google.maps.Animation.DROP,
                                        position:{lat:e.latLng.lat(), lng: e.latLng.lng() },
                                        anchorPoint: new google.maps.Point(0, -29)
                                      }); 
                                 });
                               
                              }
                           </script>
                           <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDre1VDn9vLz8GPlSODwfPNGeYKoRpCpbw&callback=initMap" async defer></script>
                        </body>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-12">About</label>
                     <div class="col-sm-12 col-md-12">
                        <textarea name="about" id="about" cols="30" rows="7"  class="form-control textarea" name="about">{{$store->description}}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 ">
                  <div class="form-group">
                     <h3 style="margin-left:12px;">Search Filter Information</h3>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Type of Food*</label>
                     <?php $Typeoffoods=\App\Models\Typeoffood::all();?>
                     <div class="col-sm-8">
                        <select name="typeoffood[]" id="typeoffood" class="js-example-basic-multiple form-control __clear__border" multiple="multiple">
                           @foreach($Typeoffoods as $Typeoffood)
                           <option value="{{$Typeoffood->id}}">{{$Typeoffood->name}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <script type="text/javascript">
                     $(".js-example-basic-multiple").val({{json_encode($store->typeoffoods()->getRelatedIds())}}).trigger('change');
                     
                  </script>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Type of Place*</label>
                     <?php $Typeofplaces=\App\Models\Typeofplace::all();?>
                     <div class="col-sm-8">
                        <select name="typeofplace[]" id="typeofplace" class="typeofplace form-control __clear__border" multiple="multiple">
                        @foreach($Typeofplaces as $Typeofplace)
                        <option value="{{$Typeofplace->id}}" @if($Typeofplace->id==$store->typeofplace_id):  selected @endif;>{{$Typeofplace->placename}}</option>
                        @endforeach
                        </select>
                     </div>
                  </div>
                  <script type="text/javascript">
                     $(".typeofplace").val({{json_encode($store->places()->getRelatedIds())}}).trigger('change');
                  </script>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-4 ">Average Price*</label>
                     <div class="col-sm-8">
                        <div class="row __clear__margin">
                           <div class="col-md-4 __clear__padding">
                              <div class="col-sm-12 __clear__padding">
                                 <input type="text" class="form-control" id="pricefrom" name="pricefrom" value="{{$store->pricefrom}}">
                              </div>
                           </div>
                           <div class="col-md-8 __clear__padding">
                              <label for="inputPassword3" class="col-sm-4 col-offset-1__clear__padding">&nbsp; To</label>
                              <div class="col-sm-6 col-sm-offset-2 __clear__padding">
                                 <input type="text" class="form-control" id="priceto" name="priceto" value="{{$store->priceto}}">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-12">
                     <button type="submit" class="btn btn-danger __clear__border">Update</button>
                  </div>
               </div>
            </form>
            <?php endif;?>
            <?php if(isset($_GET['change-image'])):?>
            <h3>Update Image</h3>
            <form id="form1" method="post" action="{{route('postUserChangeImage')}}" enctype="multipart/form-data">
               <input type="hidden" value="{{Auth::user()->id}}" name="id">
               <div class="form-group">  
                  <input type='file' id="inputFile" class="form-control" name="files[]" required/>
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-info __clear__border">Save</button>
               </div>
               <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
            <div class="form-group">
               <img id="image_upload_preview" src="http://placehold.it/100x100" alt="your image" style="max-width:100px;max-height: 100px;"/>
            </div>
            <script>
               function readURL(input) {
                 if (input.files && input.files[0]) {
                     var reader = new FileReader();
               
                     reader.onload = function (e) {
                         $('#image_upload_preview').attr('src', e.target.result);
                     }
               
                     reader.readAsDataURL(input.files[0]);
                 }
               }
               
               $("#inputFile").change(function () {
                 readURL(this);
               });
            </script>
            <?php elseif(isset($_GET['edit-profile'])):?>
            <h3>Edit Profile</h3>
            <form action="{{route('postUserUpdateProfile')}}" method="post">
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <input type="hidden" name="id" value="{{Auth::user()->id}}">
               <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" name="username" id="" class="form-control" value="{{(Auth::user())?Auth::user()->username:''}}">
               </div>
               <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" name="email" id="email" class="form-control" value="{{(Auth::user())?Auth::user()->email:''}}">
               </div>
               <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" id="password" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="">Sex</label>
                  <select name="sex" id="sex" class="form-control" >
                  <option value="Male" {{(Auth::user()->sex=='Male')?'selected':''}}>Male</option>
                  <option value="Female" {{(Auth::user()->sex=='Female')?'selected':''}}>Female</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="">Phone</label>
                  <input type="number" name="phone" id="phone" class="form-control" value="{{(Auth::user())?Auth::user()->phone:''}}">
               </div>
               <div class="form-group">
                  <label for="">Date Of Brith</label>
                  <input type="date" name="dob" id="dob" class="form-control" value="{{(Auth::user())?Auth::user()->date_of_birth:''}}">
               </div>
               <div class="form-group">
                  <label for="">Address</label>
                  <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{(Auth::user())?Auth::user()->address:''}}</textarea>
               </div>
               <div class="form-group">
                  <button class="btn btn-info __clear__border">Update Profile</button>
               </div>
            </form>
            <?php elseif(isset($_GET['list-store'])):?>
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h4>
                     <div class="fa fa-user"> </div>
                     Page Managment
                  </h4>
               </div>
               <div class="panel-body">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>Page Name</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($singularUser->stores as $store)
                        @if($store->status==1)
                        <tr>
                           <td>@if($store->approval!="1") <a href="{{route('getEditStore',array('id'=>bcrypt($store->id).'keystore'.$store->id,'key'=>bcrypt($singularUser->id).'authentication'.$singularUser->id))}}">{{$store->name}}</a> @else<a href="{{route('getEditStore',array('id'=>bcrypt($store->id).'keystore'.$store->id,'key'=>bcrypt($singularUser->id).'authentication'.$singularUser->id))}}">{{$store->name}}</a>@endif</td>
                           <td>@if($store->approval!="1") Page not yet activated @else Activated @endif</td>
                           <td>@if($store->approval!="1")<i class="fa fa-cog"></i> Manage</a> @else<a href="{{route('postAddManageUserPage',array('store_id'=>$store->id,'keygerate'=>bcrypt($store->id),'owner_page'=>$singularUser->id))}}" style="text-decoration:none;"><i class="fa fa-cog"></i> Manage</a>@endif</td>
                        </tr>
                        @endif
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <?php elseif(isset($_GET['create-page'])):?>
            <form class="form-horizontal __form__user" id="create" style="font-size:12px;" action="{{route('postSaveRestaurant')}}" method="post" enctype="multipart/form-data" id="__form__user">
               <div class="col-md-6 __clear__padding">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <h3 style="margin-left:12px;">General Information</h3>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Restaurant  Name*</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name" required>
                     </div>
                  </div>
                  <div class="form-group" onclick="myDropZone();">
                     <label for="inputEmail3" class="col-sm-4">Profile photo</label>
                     <div class="col-sm-8">
                        <div class="form-control">
                           <img src="{{asset('uploads/1478868224_instagram_online_social_media.png')}}" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12" style="border:1px solid #ccc;">
                     <div class="box__image form-group">
                        @for($i=0;$i<1;$i++)
                        <div class="thumbnail" style="width:112px;height:100px;border:1px solid transparent;float:left;margin:12px;box-sizing:border-box;"></div>
                        @endfor
                     </div>
                  </div>
                  <div class="clearfix" style="margin-bottom:20px;"></div>
                  <div class="form-group">
                     <div class="col-md-12">
                        <button class="btn btn-primary  btn-block" type="button" onclick="businnesshour()"> <i class="fa fa-calendar" aria-hidden=""></i> Businnese hour</button>
                     </div>
                     <input type="hidden" name="buz" id="buz">
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Email</label>
                     <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" required placeholder="example@gmail.com">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Address*</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" name="address" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Phone Number*</label>
                     <div class="col-sm-8">
                        <input type="number" class="form-control" id="phone" name="phone" required>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Website</label>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" id="website" name="website" placeholder="http://www.website.com" >
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-12">Google map</label>
                     <div class="col-sm-12 col-md-12">
                        <style>
                           html, body {
                           height: 100%;
                           margin: 0;
                           padding: 0;
                           }
                           #map {
                           max-width:100%;
                           height: 400px;
                           }
                           #searchInput {
                           background-color: #fff;
                           font-family: Roboto;
                           font-size: 15px;
                           font-weight: 300;
                           margin-left: 12px;
                           padding: 0 11px 0 13px;
                           text-overflow: ellipsis;
                           width: 50%;
                           }
                           #searchInput:focus {
                           border-color: #4d90fe;
                           }
                        </style>
                        </head>
                        <body>
                           <input id="searchInput" class="controls" type="text" placeholder="Enter a location">
                           <div id="map"></div>
                           <ul id="geoData">
                              <input type="hidden" id="location" name="maplocation" >
                              <input type="hidden" id="postal_code" name="mappostal_code">
                              <input type="hidden" id="country" name="mapcountry">
                              <input type="hidden" id="lat" name="maplat">
                              <input type="hidden" id="lon" name="maplon">
                           </ul>
                           <script>
                              function initMap() {
                                  var map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: -33.8688, lng: 151.2195},
                                    zoom: 13
                                  });
                                  var input = document.getElementById('searchInput');
                                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                              
                                  var autocomplete = new google.maps.places.Autocomplete(input);
                                  autocomplete.bindTo('bounds', map);
                              
                                  var infowindow = new google.maps.InfoWindow();
                                  var marker = new google.maps.Marker({
                                      map: map,
                                      position:{lat: -33.8688, lng: 151.2195},
                                      anchorPoint: new google.maps.Point(0, -29)
                                  });
                              
                                  autocomplete.addListener('place_changed', function() {
                                      infowindow.close();
                                      marker.setVisible(false);
                                      var place = autocomplete.getPlace();
                                      if (!place.geometry) {
                                          window.alert("Autocomplete's returned place contains no geometry");
                                          return;
                                      }
                                
                                      // If the place has a geometry, then present it on a map.
                                      if (place.geometry.viewport) {
                                          map.fitBounds(place.geometry.viewport);
                                      } else {
                                          map.setCenter(place.geometry.location);
                                          map.setZoom(17);
                                      }
                                      marker.setIcon(({
                                          url: place.icon,
                                          size: new google.maps.Size(71, 71),
                                          origin: new google.maps.Point(0, 0),
                                          anchor: new google.maps.Point(17, 34),
                                          scaledSize: new google.maps.Size(35, 35)
                                      }));
                                      marker.setPosition(place.geometry.location);
                                      marker.setVisible(true);
                                  
                                      var address = '';
                                      if (place.address_components) {
                                          address = [
                                            (place.address_components[0] && place.address_components[0].short_name || ''),
                                            (place.address_components[1] && place.address_components[1].short_name || ''),
                                            (place.address_components[2] && place.address_components[2].short_name || '')
                                          ].join(' ');
                                      }
                                  
                                      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                                      infowindow.open(map, marker);
                                    
                                      //Location details
                                      for (var i = 0; i < place.address_components.length; i++) {
                                          if(place.address_components[i].types[0] == 'postal_code'){
                                              document.getElementById('postal_code').value = place.address_components[i].long_name;
                                          }
                                          if(place.address_components[i].types[0] == 'country'){
                                              document.getElementById('country').value = place.address_components[i].long_name;
                                          }
                                      }
                                      document.getElementById('location').value = place.formatted_address;
                                      document.getElementById('lat').value = place.geometry.location.lat();
                                      document.getElementById('lon').value = place.geometry.location.lng();
                                  });
                                  google.maps.event.addListener(map, 'click', function (e) {
                                      
                                      document.getElementById('lat').value = e.latLng.lat();
                                      document.getElementById('lon').value = e.latLng.lng();
                                      var marker = new google.maps.Marker({
                                        map: map,
                                        draggable: true,
                                        animation: google.maps.Animation.DROP,
                                        position:{lat:e.latLng.lat(), lng: e.latLng.lng() },
                                        anchorPoint: new google.maps.Point(0, -29)
                                      });   
                                 });
                              }
                           </script>
                           <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDre1VDn9vLz8GPlSODwfPNGeYKoRpCpbw&callback=initMap" async defer></script>
                        </body>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-12">About</label>
                     <div class="col-sm-12 col-md-12">
                        <textarea name="about" id="about" cols="30" rows="7"  class="form-control textarea" name="about"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                  </div>
               </div>
               <div class="col-sm-6 __form-createpage">
                  <div class="form-group">
                     <h3 style="margin-left:12px;">Search Filter Information</h3>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Type of Food*</label>
                     <?php $Typeoffoods=\App\Models\Typeoffood::all();?>
                     <div class="col-sm-8">
                        <select name="typeoffood[]" id="typeoffood" class="js-example-basic-multiple form-control __clear__border" multiple="multiple">
                           @foreach($Typeoffoods as $Typeoffood)
                           <option value="{{$Typeoffood->id}}">{{$Typeoffood->name}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputEmail3" class="col-sm-4">Type of Place*</label>
                     <?php $Typeofplaces=\App\Models\Typeofplace::all();?>
                     <div class="col-sm-8">
                        <select name="typeofplace[]" id="typeofplace" class="form-control typeofplace" name="typeofplace" multiple="multiple">
                           @foreach($Typeofplaces as $Typeofplace)
                           <option value="{{$Typeofplace->id}}">{{$Typeofplace->placename}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputPassword3" class="col-sm-4 ">Average Price*</label>
                     <div class="col-sm-8">
                        <div class="row __clear__margin">
                           <div class="col-md-4 __clear__padding">
                              <div class="col-sm-12 __clear__padding">
                                 <input type="text" class="form-control" id="pricefrom" name="pricefrom">
                              </div>
                           </div>
                           <div class="col-md-8 __clear__padding">
                              <label for="inputPassword3" class="col-sm-4 col-offset-1__clear__padding">&nbsp; To</label>
                              <div class="col-sm-6 col-sm-offset-2 __clear__padding">
                                 <input type="text" class="form-control" id="priceto" name="priceto">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-12">
                     <button type="submit" class="btn btn-danger __clear__border">Save</button>
                     
                  </div>
               </div>
            </form>
            <?php elseif(isset($_GET['owner_page'])):?>
            <div class="form-group">
               <input type="text" name="" id="emailorname" class="form-control" placeholder="Type a name or Email to manag your page">
               <input type="hidden" name="store" value="{{$_GET['store_id']}}" id="store_id">
               <span class="text-danger status" id="status"></span>
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary btn-xs save">Save</button>
            </div>
            <hr>
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h4>
                     <div class="fa fa-user"> </div>
                     Mange User
                  </h4>
               </div>
               <div class="panel-body">
                  <?php $store=\App\Models\Store::find($_GET['store_id']);?>
                  @foreach($store->users as $user)
                  <div class="form-group">
                     @if($user->id !=$_GET['owner_page'])
                     <p>{{$user->email}}</p>
                     <button class="remove btn btn-primary btn-xs removeUser" data="{{$user->id}}">Remove User</button>
                     <input type="hidden" name="" class="storeID" value="{{$_GET['store_id']}}">
                     @endif
                  </div>
                  @endforeach
               </div>
            </div>
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h4>
                     <div class="fa fa-tags"> </div>
                     Food Menus
                  </h4>
               </div>
               <div class="panel-body">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Post Name</th>
                           <th>Image</th>
                           <th>Price</th>
                           <th>Created_at</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($store->menufoods as $food)
                        <tr>
                           <td>{{$food->name}}</td>
                           <td><img src="{{asset('uploads')}}/{{$food->image}}" width="50" alt="" class="previewImage"></td>
                           <td>${{$food->price}}</td>
                           <td>{{$food->created_at}}</td>
                           <input type="hidden" name="" value="{{$food->id}}" id="pid">
                           <input type="hidden" name="" value="{{$food->name}}" id="pname">
                           <input type="hidden" name="" value="{{$food->price}}" id="pprice">
                           <input type="hidden" name="" value="{{$food->image}}" id="pimage">
                           <input type="hidden" name="" value="{{$food->description}}" id="pdescription">
                           <td><a href="#" class="btn btn-info btn-xs editPostFood" >Edit</a> <a href="#" class="btn btn-danger btn-xs deletPostFood">Delete</a></td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <script type="text/javascript">
               // $("#emailorname").mouseout(function(){
               //     var emailorname=$("#emailorname").val();
               //     var store_id=$("#store_id").val();
               //     jQuery.ajax({
               //       url:"route('getCheckExistUsrnameOrEmail')",
               //       type:"GET",
               //       data:{emailorname:emailorname,store_id:store_id},
               //       success:function(data){
               //        $("#status").text("");
               //       },
               //       error:function(data){
               //         $("#status").text("User not found!");
               //       }
               //     });
               // })
               $(function() {
                      $("#emailorname").autocomplete({
                          source: "{{route('search.user')}}",
                          minLength: 1,
                          select: function(event, ui) {
                              $('emailorname').val(ui.item.value);
                          }
                      });
                      $('#emailorname').data("ui-autocomplete")._renderItem = function(ul, item) {
                          var $li = $("<li style='width:800px;margin-left:10px;margin-bottom:5px'>");
                             $li.attr('data-value', item.value);
                             $li.append("");
                             $li.append("<br/>" + item.value);
                             return $li.appendTo(ul);
                     
                      };
                     });
               $(".save").click(function(e){
                   e.preventDefault();
                   var emailorname=$("#emailorname").val();
                   var store_id=$("#store_id").val();
                   if(emailorname==""){
                     alert("Please Name or Email Address User");
                   }
                   jQuery.ajax({
                     url:"{{route('getSaveUserManagmentPage')}}",
                     type:"GET",
                     data:{emailorname:emailorname,store_id:store_id},
                     success:function(data){
                       alert("User has been added to page");
                       window.location.reload();
                       $("#emailorname").val("");
                     },
                     error:function(data){
                         alert("Erro");
                     }
                   });
               });
               $(".removeUser").click(function(){
                   var userID=$(this).attr('data');
                   var storeID=$(".storeID").val();
                   jQuery.ajax({
                     url:"{{route('getRemoveUserFromPage')}}",
                     type:"GET",
                     data:{userID:userID,storeID:storeID},
                     success:function(data){
                       console.log(data);
                       window.location.reload();
                     },
                     error:function(data){
                       console.log(data);
                     }
               
                   });
               
               });
            </script>
            @elseif(!$_GET)
            <div class="__block__save">
               @if(count(Auth::user()->saveStore) <=0)
               @else
               <p><i class="fa fa-bookmark"></i> {{count(\Auth::user()->saveStore)}} Saved <a href="{{route('store.all.save')}}">(See All)</a></p>
               @endif
               @foreach(Auth::user()->saveStoreLimit as $store)
               <div class="col-md-4 __block__save-img">
                  @php
                  $imageArray=explode("||", $store->images);
                  @endphp
                  <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">
                  @if(empty($store->images))
                  <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive height">
                  @else
                  <img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive height">
                  @endif
                  </a>
                  <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><b>{{$store->name}}</b></a>
                  <p>Rate
                     @php
                     $rating=ceil($store->rating);
                     @endphp
                     @foreach(range(1,5) as $rate)
                     @if($rate<=$rating)
                     <i class="fa fa-star rated"></i>
                     @else
                     <i class="fa fa-star"></i>
                     @endif
                     @endforeach
                     <span>(view {{$store->view}})</span>
                  </p>
                  <address>{{substr($store->address,0,50)}}...</address>
               </div>
               @endforeach
            </div>
            <div class="clearfix" style="display: block;clear:both;"></div>
            <hr>
            <div class="__box__review __box__review-saved">
               @if(count(\Auth::user()->reviewStore)<=0)
               <p>You has no Review</p>
               @else
               <p><i class="fa fa-pencil-square-o"></i> {{count(\Auth::user()->reviewStore)}} Revew <a href="{{route('store.getListReview',array('userID'=>Auth::user()->id,'key'=>bcrypt(Auth::user()->id)))}}">(See All)</a></p>
               @foreach(Auth::user()->reviewStoreLimit as $storeReview)
               <div class="__review">
                  <div class="row __saved-pro-block">
                     @php
                     $imageReview=explode("||", $storeReview->images);
                     @endphp
                     <div class="col-md-5 __saved-listblock">
                        <a href="{{route('getRestaurantDetail',array('name'=>$storeReview->name,'id'=>$storeReview->id))}}">
                        @if(empty($storeReview->images))
                        <img src="{{asset('uploads')}}/default-jongnham.jpg" alt="" class="img-responsive height">
                        @else
                        <img src="{{asset('uploads')}}/{{$imageReview[0]}}" alt="" class="img-responsive height">
                        @endif
                        </a>
                     </div>
                     <div class="col-md-7 __saved-listblockP">
                        <b><a href="{{route('getRestaurantDetail',array('name'=>$storeReview->name,'id'=>$storeReview->id))}}">{{$storeReview->name}}</a></b>
                        <p>Rate
                           @php
                           $rating=ceil($storeReview->rating);
                           @endphp
                           @foreach(range(1,5) as $rate)
                           @if($rate<=$rating)
                           <i class="fa fa-star rated"></i>
                           @else
                           <i class="fa fa-star"></i>
                           @endif
                           @endforeach
                           <span>(view {{$storeReview->view}})</span>
                        </p>
                        @php
                        $userID=Auth::user()->id;
                        $comments= $stores=DB::select("SELECT * FROM comments WHERE user_id={$userID} AND store_id ={$storeReview->id}");
                        @endphp
                        @foreach($comments as $comment)
                        <p>{{$comment->comment_body}}</p>
                        @endforeach
                        <a href="{{route('store.reviewpreview',array('userID'=>Auth::user()->id,'id'=>$storeReview->id,'key'=>bcrypt(Auth::user()->id)))}}" style="color:darkorange;">Edit</a>
                     </div>
                  </div>
                  
               </div>
               @endforeach
               @endif
            </div>
            <?php endif;?>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   tinymce.init({
     selector: '.textarea',
     height: 150,
     plugins: [
       'advlist autolink lists link image charmap print preview anchor',
       'searchreplace visualblocks code fullscreen',
       'insertdatetime media table contextmenu paste code'
     ],
     toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
     content_css: '//www.tinymce.com/css/codepen.min.css'
   });
   $( "#__form__user").validate({
     rules: {
       name: {
         required: true,
       },
       address: {
         required: true,
       },
       email: {
         required: true,
         email: true,

       },
       phone: {
         required: true,
         number: true,
       },
       pricefrom: {
         required: true,
         number: true
       },
       priceto: {
         required: true,
         number: true
       }
     }
   });
   $(".previewImage").click(function(e){
      $(".imageModal").modal('show');
      var image=$(this).parent().parent().find('#pimage').val();
      var storeImage=$(this).parent().parent().find('#pid').val();
      $(".imgp").attr('src',"{{asset('uploads')}}/"+image);
      $("#storeImage").val(storeImage);
   });
   $('body').on('click','.updatefood',function(e){
      e.preventDefault();
      var name=$("#mname").val();
      var price=$("#mprice").val();
      var description=$("#mdescription").val();
      var id=$("#mid").val();
      jQuery.ajax({
        url:"{{route('getAjaxUpdateFood')}}",
        type:"GET",
        data:{name:name,price:price,description:description,id:id},
        success:function(data){
          window.location.reload();
        },
        error:function(data){
   
        }
      });
   });
   $(".deletPostFood").click(function(e){
      e.preventDefault();
       var id=$(this).parent().parent().find('#pid').val();
       var conf=confirm("Do you want to delete?");
       if(conf==true){
       jQuery.ajax({
          url:"{{route('deletepostimagestore')}}",
          type:"GET",
          data:{id:id},
          success:function(data){
              window.location.reload();
          }
       });
     }
   
   });
   function myDropZone(){
      $(".myDropZone").modal("show");
   jQuery.ajax({
         url:"{{route('reomovegallery')}}",
         type:"GET",
         data:{},
         success:function(data){
            console.log(data);
         }
      });
   }
</script>
<script src="{{asset('js/posts.js')}}"></script>
<!--Modal Edit store-->
<div class="modal fade modeFood " id="modal-1">
   <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content __clear__border">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">
               <div class="fa fa-edit"> </div>
               Edit Food
            </h4>
         </div>
         <form action="{{route('getAjaxUpdateFood')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" id="mname" class="form-control">
               </div>
               <div class="form-group">
                  <label for="">Price</label>
                  <input type="text" name="price" id="mprice" class="form-control">
               </div>
               <div class="form-group">
                  <label for="">Description</label>
                  <textarea name="description" id="mdescription" cols="30" rows="5" class="form-control"></textarea>
                  <input type="hidden" name="id" id="mid">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary __clear__border" data-dismiss="modal" >Close</button>
               <button type="submit" class="btn btn-primary __clear__border updatefood">Update Now</button>
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modal Image-->
<div class="modal imageModal fade __clear__border" id="modal-1">
   <div class="modal-dialog __clear__border" role="document">
      <div class="modal-content __clear__border">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title"><i class="fa fa-picture-o"></i> Image Preview</h4>
         </div>
         <div class="modal-body">
            <img src="" alt="" class="imgp" style="min-width: 100%;max-width: 100%;">
            <hr>
            <form action="{{route('postChangeImageFood')}}" enctype="multipart/form-data" method="post">
               <input type="hidden" name="_token" value="{{Session::token()}}">
               <div class="form-group">
                  <label for="">Change Image</label>
               </div>
               <div class="form-group">
                  <input type="file" name="photo" id="" class="form-control">
                  <input type="hidden" name="id" id="storeImage">
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-primary __clear__border">Change Image</button>
               </div>
            </form>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--End image Proview Modal-->
<!--modal dropzone-->
<div class="modal myDropZone fade" id="modal-1">
   <div class="modal-dialog" role="document">
      <div class="modal-content __clear__border">
         <div class="modal-header">
            <button type="button" class="close upload" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">
               <div class="fa fa-photo"></div>
               Upload FIle
            </h4>
         </div>
         <div class="modal-body">
            {!! Form::open([ 'route' => [ 'dropzone.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
            <div>
            </div>
            {!! Form::close() !!}
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--Modal Business Hour-->
<div class="modal fade businness" id="modal-1">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content __clear__border">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title"><i class="fa fa-calendar"></i> Business Hour</h4>
         </div>
         <div class="modal-body">
            <table class="table table-bordered hour" style="font-size:12px;">
               <thead>
                  <tr>
                     <th style="font-size:12px;"><i class="fa fa-calendar"></i> Day</th>
                     <th style="font-size:12px;"><i class="fa fa-calendar"></i> From</th>
                     <th style="font-size:12px;"><i class="fa fa-calendar"></i> To</th>
                     <th style="font-size:12px;"><i class="fa fa-calendar"></i> From</th>
                     <th style="font-size:12px;"><i class="fa fa-calendar"></i> To</th>
                  </tr>
               </thead>
               <tr class="copy title="Copy"">
                  <td class="Monday"><b>Monday</b></td>
                  <td style="position:relative;"><input type="text" name="" id="" class="form-control __clear__border  timepicker m1" ><i class="fa fa-clone mco" title="Copy"></i></td> 
                  <td style="position:relative;"><input type="text" name="" id="" class="form-control __clear__border  timepicker m2" ><i class="fa fa-clone tco" title="Copy"></i></td> 
                  <td style="position:relative;"><input type="text" name="" id="" class="form-control __clear__border  timepicker m3 pm" ><i class="fa fa-clone wco" title="Copy"></i></td> 
                  <td style="position:relative;"><input type="text" name="" id="" class="form-control __clear__border  timepicker m4 pm" ><i class="fa fa-clone thco" title="Copy"></i></td>
               </tr>
               <tr>
                  <td class="Tuesday"><b>Tuesday</b></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker t1" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker t2" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker t3 pm" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker t4 pm" ></td>
               </tr>
               <tr class="Wednesday">
                  <td><b>Wednesday</b></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker w1" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker w2" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker w3 pm" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker w4 pm" ></td>
               </tr>
               <tr class="Thursday">
                  <td><b>Thursday</b></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker th1" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker th2" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker th3 pm" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker th4 pm" ></td>
               </tr>
               <tr class="Friday">
                  <td><b>Friday</b></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker f1" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker f2" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker f3 pm" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker f4 pm" ></td>
               </tr>
               <tr class="Saturday">
                  <td><b>Saturday</b></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker sa1""></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker sa2" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker sa3 pm" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker sa4 pm" ></td>
               </tr>
               <tr class="Sunday">
                  <td><b>Sunday</b></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker su1" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker su2" ></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker su3 pm""></td>
                  <td><input type="text" name="" id=""  class="form-control __clear__border timepicker su4 pm" ></td>
               </tr>
            </table>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary __clear__border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary __clear__border" onclick="getCalendar()">Save changes</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--End Modal Business Hour-->
<!--Modal Preview-->
      <div class="modal fade preview" id="modal-1">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content __clear__border">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
                  </button>
                  <h4 class="modal-title">Preview</h4>
               </div>
               <div class="modal-body">
               <div class="col-md-8 __clear__padding__left">
                  <h2 class="preview__title" style="margin:0px 0px 6px 0px;">Jongnhams</h2>
                  <img src="" alt="image__preview" class="img-responsive preview__img">
                  <div class="__preview__about">
                  <div class="__about__restuarant">
                     <h2 class=" ">About</h2>
                  </div>
                     <p></p>
                  </div>
                  <div class="working__day">
                     
                  </div>
               </div>
               <div class="col-md-4 __clear__padding__right  __restuarant__information" style=" margin-top: 39px;">
               <h3>Restuarant Information</h3>
                  <ul class="list-unstyled">
                     <li><i class="fa fa-phone"></i> <span class="preview__phone"></span></li>
                     <li><i class="fa fa-envelope-o"></i><span class="previe__email"></span></li>
                     <li><i class="fa fa-firefox"></i> <span class="preview__website"></span></li>
                     <li><i class="fa fa-map-marker"></i> <span class="preview__location"></span></li>
                      <li><i class="fa fa-clock-o"></i> <span class="preview__working"></span></li>
                </ul>
               </div>
               <div class="clearfix"></div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary __clear__border" data-dismiss="modal">Close</button>
               </div>
            </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!--Modal Preview-->
<script type="text/javascript">
   $.datetimepicker.setLocale('en');

   $('.timepicker').datetimepicker({
      datepicker:false,
      format:'H:i',
      step:5
   });
   function preview (){
      var m=$('.preview').hasClass('in');
      var name=$("#name").val();
      var email=$("#email").val();
      var address=$("#address").val();
      var phone=$("#phone").val();
      var website=$("#website").val();
      var image=$(".box__image  img").attr('src');
      var location=$("#location").val();
      var about=tinyMCE.activeEditor.getContent();

      if(name ==""  || email=="" || address=="" || phone=="" || website==""){
         alert("Your information not enought!");
      }else{
         $(".preview").modal("show");
         $(".preview__title").text(name);
         $(".preview__img").attr('src',image);
         $(".__preview__about  p").html(about);
         $(".preview__phone").text(phone);
         $(".previe__email").text(email);
         $(".preview__website").text(website);
         $(".preview__location").text(location);
      }

   }
   $("body").click(function(){
      var m=$('body').hasClass('modal-open');
      if(m==false){
         $(".modal-backdrop").css({"display":"none"});
      }
   });
   function businnesshour(){
       $(".businness").modal("show");
   }
   
   function express(control){
          var  regex=/([0-9]):([0-9])|([ ])([AM])|([am])|([PM])|([pm])/g;
          if(control.match( regex)){
              alert("match!");
          }
   }

   $("#website").on('mouseout',function(){
         var express=/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g;
         var str=$(this).val();
        if(str.match( express)){
             
          }else{
         $( "<p class='error '>Please enter a valid URL.</p>" ).insertAfter( "#website" );
      }
   }).on('mouseenter',function(){
      $(this).nextAll().remove();
   });
   $(".hour input").blur(function(){
          var string=$(this).val();
          var  regex=/([0-9]):([0-9])/g;
          if(string !=""){  
             if(!string.match( regex)){
                $(this).val("8:00 ")
             }
          }
   });
   function getCalendar(){
   var checkSa=null;
   var checkSu=null;
    var m="'mon'=>[",t="'tue'=>[",w="'wed'=>[",th="'thu'=>[",f="'fri'=>[",sa="'sat'=>[",su="'sun'=>[";
    for(var i=1;i<=4;i++){
      if(i==1){
         m+="'"+$(".m"+i).val()+"-";
         t+="'"+$(".t"+i).val()+"-";
         w+="'"+$(".w"+i).val()+"-";
         th+="'"+$(".th"+i).val()+"-";
         f+="'"+$(".f"+i).val()+"-";
         sa+="'"+$(".sa"+i).val()+"-";
         su+="'"+$(".su"+i).val()+"-";
      }else if(i==2){
         m+=$(".m"+i).val()+"',";
         t+=$(".t"+i).val()+"',";
         w+=$(".w"+i).val()+"',";
         th+=$(".th"+i).val()+"',";
         f+=$(".f"+i).val()+"',";
         sa+=$(".sa"+i).val()+"',";
         su+=$(".su"+i).val()+"',";
      }else if(i==3){
         m+="'"+$(".m"+i).val()+"-";
         t+="'"+$(".t"+i).val()+"-";
         w+="'"+$(".w"+i).val()+"-";
         th+="'"+$(".th"+i).val()+"-";
         f+="'"+$(".f"+i).val()+"-";
         sa+="'"+$(".sa"+i).val()+"-";
         su+="'"+$(".su"+i).val()+"-";
      }else{
         m+=$(".m"+i).val()+"',";
         t+=$(".t"+i).val()+"',";
         w+=$(".w"+i).val()+"',";
         th+=$(".th"+i).val()+"',";
         f+=$(".f"+i).val()+"',";
         sa+=$(".sa"+i).val()+"',";
         su+=$(".su"+i).val()+"',";
      }
    }

      m=m.substring(m,m.length-1)+"],";
      t=t.substring(t,t.length-1)+"],";
      w=w.substring(w,w.length-1)+"],";
      th=th.substring(th,th.length-1)+"],";
      f=f.substring(f,f.length-1)+"],";
      sa=sa.substring(sa,sa.length-1)+"],";
      su=su.substring(su,su.length-1)+"]";
      var result="["+m.concat(t).concat(w).concat(th).concat(f).concat(sa).concat(su)+"]";
      result=result.replace(/'-'/g,"' '");
      result=result.replace(/,' '/g,"");
      console.log(result);

     $("#buz").val(result);
    if($(".m1").val()==""){
       alert("Please enter workting");
    }else{
        $(".businness").modal("hide");
    }
   
   }
   $(".mco").click(function(){
       var m1=$(".m1").val();
       $(".t1").val(m1);
       $(".w1").val(m1);
       $(".th1").val(m1);
       $(".f1").val(m1);
       $(".sa1").val(m1);
       $(".su1").val(m1);
   });
    $(".tco").click(function(){
       var m2=$(".m2").val();
       $(".t2").val(m2);
       $(".w2").val(m2);
       $(".th2").val(m2);
       $(".f2").val(m2);
       $(".sa2").val(m2);
       $(".su2").val(m2);
   });
    $(".wco").click(function(){
       var m3=$(".m3").val();
       $(".t3").val(m3);
       $(".w3").val(m3);
       $(".th3").val(m3);
       $(".f3").val(m3);
       $(".sa3").val(m3);
       $(".su3").val(m3);
   });
       $(".thco").click(function(){
       var m4=$(".m4").val();
       $(".t4").val(m4);
       $(".w4").val(m4);
       $(".th4").val(m4);
       $(".f4").val(m4);
       $(".sa4").val(m4);
       $(".su4").val(m4);
   });
    $(".upload").click(function(){
      jQuery.ajax({
        url:"{{route('gallery')}}",
        type:"GET",
        dat:{},
        success:function(data){
          $(".box__image").html("");
        $(jQuery.parseJSON(JSON.stringify(data))).each(function() {  
          var fileName = this.fileName;
          $(".box__image").append("<img src='{{asset('uploads')}}/"+fileName+"' style='width:112px;height:112px;margin:15px;'>");
    
        });
        },
        error:function(){
    
        }
      });
    });
    $(".js-example-basic-multiple").select2();
    $(".typeofplace").select2();
    
    
    $(".delete").click(function(){
        
        var id=$(".delete").attr('dataid');
        var key= $(this).attr('datakey');
        var dataimage=$(".delete").attr('dataimage');
        jQuery.ajax({
          url:"{{route('delete.gallery')}}",
          type:"GET",
          data:{id:id,key:key,dataimage:dataimage},
          success:function(data){
            window.location.reload();
            console.log(data);
          },
          error:function(){
    
          }
        });
    });
   
</script>
