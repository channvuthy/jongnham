@extends('version2.layouts.master')
@section('title')
    Search Results
@stop
@section('content')
    <div class="save">
        @include('version2.layouts.inc.headerrestuarant')
        <div class="container __search-result">

            <div class="row">
                <div class="col-md-3 left__sidebar">
                    <form action="{{route('searchFilter')}}" method="get" enctype="multipart/form-data">
                        <input type="hidden" name="restaurantname" value="">
                        <h3>Search Filter</h3>
                        <div class="__childe__left__sidebar type__of__food">
                            <h4>Type of Food</h4>
                            @php
                                $type__of__food=App\Models\Typeoffood::all();
                                $f=1;
                            @endphp
                            @foreach($type__of__food as $food)
                                @if($f<=5)
                                    <p><input type="checkbox" name="typeoffood" id="" value="{{$food->name}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$food->name}}
                                    </p>
                                @else
                                    <p class="hidden hiddenfood"><input type="checkbox" name="typeoffood" id=""
                                                                        value="{{$food->name}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$food->name}}
                                    </p>
                                @endif
                                @php
                                    $f++;
                                @endphp
                            @endforeach
                            <div class="see_all text-center">
                                <a href="#" class="seeHiddenFood">See All</a>
                            </div>
                        </div>
                        <div class="__childe__left__sidebar locations">
                            <h4>Location</h4>
                            @php
                                $locations =App\Models\Location::all();
                                $l=1;
                            @endphp
                            @foreach($locations as $location)
                                @if($l<=5)
                                    <p><input type="checkbox" name="location" id="location" class="location"
                                              value="{{$location->name}}">&nbsp;&nbsp; {{$location->name}}</p>
                                @else
                                    <p class="hidden hiddenlocation"><input type="checkbox" name="location"
                                                                            id="location"
                                                                            class="location">&nbsp;&nbsp; {{$location->name}}
                                    </p>
                                @endif
                                @php
                                    $l++;
                                @endphp
                            @endforeach
                            <div class="see__all text-center">
                                <a href="#" class="seetHiddenLocation">See All</a>
                            </div>
                        </div>
                        <div class="__childe__left__sidebar type__of__place">
                            <h4>Type of Place</h4>
                            @php
                                $p=1;
                                $type__of__places=App\Models\Typeofplace::all();
                            @endphp
                            @foreach($type__of__places as $place)
                                @if($p<=5)
                                    <p><input type="checkbox" name="place"
                                              value="{{$place->placename}}">&nbsp;&nbsp;{{$place->placename}}</p>
                                @else
                                    <p class="hidden hidden__place"><input type="checkbox" name="place"
                                                                           value="{{$place->placename}}">&nbsp;&nbsp;{{$place->placename}}
                                    </p>
                                @endif
                                @php $p++;@endphp
                            @endforeach
                            <div class="see__all text-center">
                                <a href="#" class="seeHiddenPlace">See All</a>
                            </div>
                        </div>
                        <div class="__button__search">
                            <button type="submit" class="search__button btn btn-block">Search</button>
                        </div>
                        <div class="__facebook__page">
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=827457514058226";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="fb-page" data-href="https://www.facebook.com/jongnhams/" data-tabs="timeline"
                                 data-width="268" data-height="160" data-small-header="true"
                                 data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/jongnhams/" class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/jongnhams/">ចង់ញុាំ Jongnham</a></blockquote>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="title search_result text-center">
                            Search Results
                        </h3>
                        <div class="sort">
                            <div id="SortByPrice">Sort By:</div>
                            @if(session()->get('location'))
                                <div id="SortByDistance">Distance</div> @endif
                            <div id="SortByRanking">Ranking</div>
                            <div id="SortByView">View</div>
                            <div id="SortByPrices">Price</div>
                        </div>
                        <div class="ResultSearch">

                        </div>
                    </div>
                    <div class="col-md-9 right__padding __clear__padding__right">

                    </div>

                </div>
            </div>

            <div class="row">
                <h2 class="__recommended__place text-center">Recommended Place for Find</h2>
                @php
                    $stores=App\Models\Store::where('recommended','1')->get();
                @endphp
                @foreach($stores as $store)
                    <div class="col-md-3 __recommended">
                        <div class="__box__recommended" style="border:1px solid #ccc">
                            @php
                                $imageArray=explode("||", $store->images);
                            @endphp
                            <a href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}"><img
                                        src="{{asset('uploads')}}/{{$imageArray[0]}}" alt="" class="img-responsive">
                            </a>
                            <h4 class="__title__recommend"><b><a
                                            href="{{route('getRestaurantDetail',array('name'=>$store->name,'id'=>$store->id))}}">{{$store->name}}</a></b>
                            </h4>
                            <p>
                                Rate
                                @php
                                    $star=ceil($store->rating);
                                @endphp
                                @foreach(range(1,5) as $rate)
                                    @if($rate<=$star)
                                        <span class="fa fa-star rated"></span>
                                    @else
                                        <span class="fa fa-star rated"></span>
                                    @endif
                                @endforeach
                                <span>(view {{$store->view}})</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".pagination li a").click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var location = window.location.href;
            var parts = url.split('=');
            var loc = parts.pop();
            var checkPageExists = location.indexOf("page");
            var n = location.indexOf('&page');
            var newLocation = location.substring(0, n != -1 ? n : location.length);
            if (checkPageExists > 0) {
                window.location.href = newLocation + "&page=" + loc;
            } else {
                window.location.href = location + "&page=" + loc;
            }
        });
        $(".__box__sort a").click(function (e) {
            e.preventDefault();
            var text = $(this).text();
            var location = window.location.href;
            var checkPageExists = location.indexOf('$sort');
            var n = location.indexOf('&sort');
            var newLocation = location.substring(0, n != -1 ? n : location.length);
            window.location.href = newLocation + "&sort=" + text.toLowerCase();

        });
        $(".seetHiddenLocation").click(function (e) {
            e.preventDefault();
            if ($(this).text() == 'Less') {
                $(".hiddenlocation").removeClass('Seehiddenlocation');
                $(".hiddenlocation").removeClass('hidden');
                $(this).text('See All');
            } else {
                $(".hiddenlocation").removeClass('hidden');
                $(".hiddenlocation").removeClass('Seehiddenlocation');
                $(this).text('Less');
            }

        });
        $(".seeHiddenPlace").click(function (e) {
            e.preventDefault();
            if ($(this).text() == 'Less') {
                $(".hidden__place").removeClass('Seehidden__place');
                $(".hiddenlocation").removeClass('hidden');
                $(this).text('See All');
            } else {
                $(".hidden__place").removeClass('hidden');
                $(".hiddenlocation").removeClass('Seehidden__place');
                $(this).text('Less');
            }

        });
        $(".seeHiddenFood").click(function (e) {
            e.preventDefault();
            if ($(this).text() == 'Less') {
                $(".hiddenfood").removeClass('Seehiddenfood');
                $(".hiddenfood").addClass('hidden');
                $(this).text('See All');
            } else {
                $(".hiddenfood").removeClass('hidden');
                $(".hiddenfood").addClass('Seehiddenfood');
                $(this).text('Less');
            }
        });


        $(".valuelocation").click(function () {
            var sendData = $(this).attr('data');
            jQuery.ajax({
                url: "{{route('update.distance')}}",
                type: "GET",
                data: {location: $(this).attr('data')},
                success: function (data) {
                    console.log(data);
                }
            });
        });
        $(".location").change(function () {
            if (this.checked) {
                var sendData = $(this).attr('value');
                jQuery.ajax({
                    url: "{{route('update.distance')}}",
                    type: "GET",
                    data: {location: $(this).attr('value')},
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        });
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
                                    <input type="text" placeholder="Email Address" id="email" name="email"
                                           class="form-control" required>
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Password" id="password" name="password"
                                           class="form-control">
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Confirm Password" id="cpassword"
                                           name="cpassword" class="form-control" required>
                                    <span class="text-danger">{{$errors->first('cpassword')}}</span>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-danger  __clear__border" id="__botton__register"
                                            type="submit">Register
                                    </button>
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
    <div class="modal mymodal fade __clear__border" id="modal-container-930929" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog __clear__border">
            <div class="modal-content __clear__border">
                <div class="modal-body __clear__border">
                    <div class="alert alert-success __clear__border">
                        <p>Please confirm your email address. Thank you for register!!!!!!!!!!!</p>
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
                    <h4 class="modal-title text-center">Login to your account</h4>
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
                                    <input type="text" placeholder="Email Address" id="email" name="email"
                                           class="form-control" required>
                                    <span class="text-danger">{{$errors->first('message__error')}}</span>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Password" id="password" name="password"
                                           class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-danger  __clear__border" id="__botton__register"
                                            type="submit">Login
                                    </button>
                                </div>
                                <div class="form-group">
                                    <p class="text-center">Not yet Account?<a href="#" class="registeraccount"> Register
                                            Now</a></p>
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
        $(window).load(function () {
            $('.mymodal ').modal('show');
        });
    </script>
    <?php endif;?>
    <?php if($errors->first('email')):?>
    <script type="text/javascript">
        $(window).load(function () {
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
        myImage.onload = function () {
            var position__box__search = this.height / 2;
            $(".box__search").css({
                "top": "-" + position__box__search + "px"
            });

        }
        myImage.src = $('.bg__option__search img').attr('src');
        $(".search__icon  #first__icon,.search__icon  #first__icon img, .search__icon span").hover(function () {
            $(".search__icon  #first__icon img").attr("src", "{{asset('uploads')}}/save-hover.png");
        }).mouseout(function () {
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
        $(".alreadyaccount").click(function (e) {
            e.preventDefault();
            $(".modal__register").modal('hide');
            $(".modal__login").modal();
        });
        $(".registeraccount").click(function (e) {
            e.preventDefault();
            $(".modal__register").modal('show');
            $(".modal__login").modal('hide');
        });
        $(document).ready(function () {


            jQuery.ajax({
                url: "{{route('angularSearch')}}",
                type: "GET",
                dataType: "json",

                beforeSend: function () {
                    var Loading = "";
                    for (var indexStart = 0; indexStart < 5; indexStart++) {
                        Loading += "<div class='row'><img src='{{asset('uploads/loading45.gif')}}' width='250px'></div>";
                    }
                    $(".ResultSearch").html(Loading);
                },
                success: function (data) {
                    $(".ResultSearch").html("");
                    var str = "";


                    for (var i = 0; i < data.length; i++) {
                        var rate = "";
                        for (var star = 1; star <= 5; star++) {
                            if (data[i]['rating'] >= star) {
                                rate += '<i class="fa fa-star rated"></i>';
                            } else {
                                rate += '<i class="fa fa-star"></i>';
                            }
                        }
                        str += '<div class="__box__result">' +
                            '<div class="SaveStore">@if(!Auth::check()) <a href="#" onclick=\'alert("Please Login if you want to save this place!")\' data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a>@else <a href="#" class="save" data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a> @endif</div>' +
                            '<div class="ImgResponse"><img src="{{URL::to('/')}}/uploads/' + data[i]['images'] + '" width="330px"></div>' +
                            '<h4><a href="{{URL::to('/')}}/restuarant-detail?name='+data[i]['name'].replace(/ /g , "-").toLowerCase()+'&id='+data[i]['id']+'">' + data[i]['name'] + '</a></h4>' +
                            '<p>Rate' + rate + 'View(' + data[i]['view'] + ')</p>' +
                            '<p>' + data[i]['address'] + '</p>' +
                            '' +
                            '</div>';
                    }
                    $(".ResultSearch").html(str);
                    rate = "";
                }

            });
        });
        $("#SortByRanking").click(function () {
            jQuery.ajax({
                url: "{{route('angularSearchSortByRanking')}}",
                type: "GET",
                dataType: "json",
                data: {sort: 'ranking'},

                beforeSend: function () {
                    var Loading = "";
                    for (var indexStart = 0; indexStart < 5; indexStart++) {
                        Loading += "<div class='row'><img src='{{asset('uploads/loading45.gif')}}' width='250px'></div>";
                    }
                    $(".ResultSearch").html(Loading);
                },
                success: function (data) {
                    $(".ResultSearch").html("");
                    var str = "";


                    for (var i = 0; i < data.length; i++) {
                        var rate = "";
                        for (var star = 1; star <= 5; star++) {
                            if (data[i]['rating'] >= star) {
                                rate += '<i class="fa fa-star rated"></i>';
                            } else {
                                rate += '<i class="fa fa-star"></i>';
                            }
                        }
                        str += '<div class="__box__result">' +
                            '<div class="SaveStore">@if(!Auth::check()) <a href="#" onclick=\'alert("Please Login if you want to save this place!")\' data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a>@else <a href="#" class="save" data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a> @endif</div>' +
                            '<div class="ImgResponse"><img src="{{URL::to('/')}}/uploads/' + data[i]['images'] + '" width="330px"></div>' +
                            '<h4><a href="{{URL::to('/')}}/restuarant-detail?name='+data[i]['name'].replace(/ /g , "-").toLowerCase()+'&id='+data[i]['id']+'">' + data[i]['name'] + '</a></h4>' +
                            '<p>Rate' + rate + 'View(' + data[i]['view'] + ')</p>' +
                            '<p>' + data[i]['address'] + '</p>' +
                            '' +
                            '</div>';
                    }
                    $(".ResultSearch").html(str);
                    rate = "";
                }

            });
        });
        $("#SortByView").click(function () {
            jQuery.ajax({
                url: "{{route('angularSearchSortByView')}}",
                type: "GET",
                dataType: "json",
                data: {sort: 'view'},

                beforeSend: function () {
                    var Loading = "";
                    for (var indexStart = 0; indexStart < 5; indexStart++) {
                        Loading += "<div class='row'><img src='{{asset('uploads/loading45.gif')}}' width='250px'></div>";
                    }
                    $(".ResultSearch").html(Loading);
                },
                success: function (data) {
                    $(".ResultSearch").html("");
                    var str = "";


                    for (var i = 0; i < data.length; i++) {
                        var rate = "";
                        for (var star = 1; star <= 5; star++) {
                            if (data[i]['rating'] >= star) {
                                rate += '<i class="fa fa-star rated"></i>';
                            } else {
                                rate += '<i class="fa fa-star"></i>';
                            }
                        }
                        str += '<div class="__box__result">' +
                            '<div class="SaveStore">@if(!Auth::check()) <a href="#" onclick=\'alert("Please Login if you want to save this place!")\' data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a>@else <a href="#" class="save" data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a> @endif</div>' +
                            '<div class="ImgResponse"><img src="{{URL::to('/')}}/uploads/' + data[i]['images'] + '" width="330px"></div>' +
                            '<h4><a href="{{URL::to('/')}}/restuarant-detail?name='+data[i]['name'].replace(/ /g , "-").toLowerCase()+'&id='+data[i]['id']+'">' + data[i]['name'] + '</a></h4>' +
                            '<p>Rate' + rate + 'View(' + data[i]['view'] + ')</p>' +
                            '<p>' + data[i]['address'] + '</p>' +
                            '' +
                            '</div>';
                    }
                    $(".ResultSearch").html(str);
                    rate = "";
                }

            });
        });
        $("#SortByPrices").click(function () {
            jQuery.ajax({
                url: "{{route('angularSearchSortByPrice')}}",
                type: "GET",
                dataType: "json",
                data: {sort: 'price'},

                beforeSend: function () {
                    var Loading = "";
                    for (var indexStart = 0; indexStart < 5; indexStart++) {
                        Loading += "<div class='row'><img src='{{asset('uploads/loading45.gif')}}' width='250px'></div>";
                    }
                    $(".ResultSearch").html(Loading);
                },
                success: function (data) {
                    $(".ResultSearch").html("");
                    var str = "";


                    for (var i = 0; i < data.length; i++) {
                        var rate = "";
                        for (var star = 1; star <= 5; star++) {
                            if (data[i]['rating'] >= star) {
                                rate += '<i class="fa fa-star rated"></i>';
                            } else {
                                rate += '<i class="fa fa-star"></i>';
                            }
                        }
                        str += '<div class="__box__result">' +
                            '<div class="SaveStore">@if(!Auth::check()) <a href="#" onclick=\'alert("Please Login if you want to save this place!")\' data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a>@else <a href="#" class="save" data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a> @endif</div>' +
                            '<div class="ImgResponse"><img src="{{URL::to('/')}}/uploads/' + data[i]['images'] + '" width="330px"></div>' +
                            '<h4><a href="{{URL::to('/')}}/restuarant-detail?name='+data[i]['name'].replace(/ /g , "-").toLowerCase()+'&id='+data[i]['id']+'">' + data[i]['name'] + '</a></h4>' +
                            '<p>Rate' + rate + 'View(' + data[i]['view'] + ')</p>' +
                            '<p>' + data[i]['address'] + '</p>' +
                            '' +
                            '</div>';
                    }
                    $(".ResultSearch").html(str);
                    rate = "";
                }

            });
        });
        $("#SortByDistance").click(function () {
            jQuery.ajax({
                url: "{{route('angularSearchSortByDistance')}}",
                type: "GET",
                dataType: "json",

                beforeSend: function () {
                    var Loading = "";
                    for (var indexStart = 0; indexStart < 5; indexStart++) {
                        Loading += "<div class='row'><img src='{{asset('uploads/loading45.gif')}}' width='250px'></div>";
                    }
                    $(".ResultSearch").html(Loading);
                },
                success: function (data) {
                    $(".ResultSearch").html("");
                    var str = "";


                    for (var i = 0; i < data.length; i++) {
                        var rate = "";
                        for (var star = 1; star <= 5; star++) {
                            if (data[i]['rating'] >= star) {
                                rate += '<i class="fa fa-star rated"></i>';
                            } else {
                                rate += '<i class="fa fa-star"></i>';
                            }
                        }
                        str += '<div class="__box__result">' +
                            '<div class="SaveStore">@if(!Auth::check()) <a href="#" onclick=\'alert("Please Login if you want to save this place!")\' data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a>@else <a href="#" class="save" data-id=' + data[i]['id'] + '><i class="fa fa-bookmark"></i></a> @endif</div>' +
                            '<div class="ImgResponse"><img src="{{URL::to('/')}}/uploads/' + data[i]['images'] + '" width="330px"></div>' +
                            '<h4><a href="{{URL::to('/')}}/restuarant-detail?name='+data[i]['name'].replace(/ /g , "-").toLowerCase()+'&id='+data[i]['id']+'">' + data[i]['name'] + '</a></h4>' +
                            '<p>Rate' + rate + 'View(' + data[i]['view'] + ')</p>' +
                            '<p>Distance ' + data[i]['distance'].toFixed(2) + 'Km</p>' +
                            '<p>' + data[i]['address'] + '</p>' +
                            '' +
                            '</div>';

                    }
                    $(".ResultSearch").html(str);
                    rate = "";
                }

            });
        });
        
    </script>
    <div class="clearfix" style="margin-top:100px;"></div>
    <footer>
        <div class="__footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        © Jongnhams All Right Reserved
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline pull-right">
                            <li><a href=""><span class="fa fa-facebook"></span></a></li>
                            <li><a href=""><span class="fa fa-google"></span></a></li>
                            <li><a href=""><span class="fa fa-youtube"></span></a></li>
                            <li><a href=""><span class="fa fa-twitter"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@stop


