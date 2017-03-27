@section('content')
@extends('admin.master')
@section('title')
{{$store->name}}
@stop
@include('admin.header')
@include('admin.nav')
@if(Auth::user()->permission=='1')
@include('admin.sidebar')
@endif
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
   <div class="row">
      <ol class="breadcrumb">
         <li>
            <a href="{{route('dashboard')}}">
               <svg class="glyph stroked home">
                  <use xlink:href="#stroked-home"></use>
               </svg>
            </a>
         </li>
         <li class="active">View Store</li>
      </ol>
   </div>
   <!--/.row-->
   <br><br>
   <div class="row">
      <div class="col-sm-12">
         @if($errors->has('message'))
         <div class="alert alert-success">
            {{$errors->first('message')}}
         </div>
         @endif
      </div>
      <div class="col-sm-12">
        <div class="view__store">
           <div class="col-md-7">
              <h4><b> {{$store->name}}</b></h4>
              <br>
              <?php $imageArray=explode("||",$store->images);?>
              <img src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive">
              <h4><b>About</b></h4>
              {!!$store->description!!}
           </div>
           <div class="col-md-5">
               <div class="viewdetail">
                   <h4><b>Resturant Information</b></h4>
                   <hr>
                   <p><i class="fa fa-phone"></i> {{$store->phone}}</p>
                   <p><i class="fa fa-clock-o"></i> {{date("h:i:a", strtotime($store->open))}} / {{date("h:i:a", strtotime($store->close))}}</p>
                   <p><i class="fa fa-usd"></i> {{$store->pricefrom}}$ - {{$store->priceto}}$</li></p>
                   <p><i class="fa fa-envelope-o"></i> {{$store->email}}</p>
                   <p><i class="fa fa-firefox"></i> {{$store->website}}</p>
                   <hr>
                   <a href="{{route('store.approve',['id'=>$store->id])}}" class="btn btn-default btn-xs">Approve</a>
                   <a href="{{route('store.delete.request',['id'=>$store->id])}}" class="btn btn-danger btn-xs">Delete Request</a>
                   
               </div>
             <div class="clearfix"></div>
             <br>
               <div class="viewmap">
                        <input id="searchInput" class="controls" type="hidden" placeholder="Enter a location">
                           <div id="map"></div>
                           <ul id="geoData">
                              <input type="hidden" id="location" name="maplocation" >
                              <input type="hidden" id="postal_code" name="mappostal_code">
                              <input type="hidden" id="country" name="mapcountry">
                              <input type="hidden" id="lat" name="maplat" value="{{$store->maplat}}" >
                              <input type="hidden" id="lon" name="maplon" value="{{$store->maplon}}">
                           </ul>
                           <style>
                              #map {
                              max-width:100%;
                              height: 250px;
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
               </div>
           </div>
        </div>
      </div>
   </div>
</div>
</div>
@stop