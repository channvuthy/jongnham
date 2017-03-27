<!DOCTYPE html>
<html lang="en">
   <head>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
      <meta charset="UTF-8">
      <title>@yield('title')</title>
      <link rel="icon" href="{{asset('uploads')}}/favicon.ico" type="image/x-icon"/>
      <link rel="shortcut icon" href="{{asset('uploads')}}/favicon.ico" type="image/x-icon"/>
      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/home.css')}}">
      <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
      <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
      <script src="{{asset('js/jquery.min.js')}}"></script>
      <script src="{{asset('js/owl.carousel.js')}}"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/jquery-ui.min.js')}}"></script>
      <script src="{{asset('js/jquery.matchHeight.js')}}"></script>

      <script>
         $(function() {
           $('.height').matchHeight();
           $('.height').matchHeight();
         });
         
      </script>
      <style type="text/css" media="screen">
         @font-face {
         font-family: myFirstFont;
         src: url("{{asset('fonts')}}/TT0207M.TTF");
         }
         @font-face {
         font-family: FontOne;
         src: url("{{asset('fonts')}}/TT0208M.TTF");
         }
         @font-face {
         font-family: FontTwo;
         src: url("{{asset('fonts')}}/VIVALDII.TTF");
         }
         .cat{
         background-image:url("{{asset('uploads')}}/imasia_11430268_L.jpg");
         }
         .box_category{
         background-image:url("{{asset('uploads')}}/shutterstock_81319588.jpg");
         }
         .specefic_category{
         background-image:url("{{asset('uploads')}}/shutterstock_162536714.jpg");
         }
         @include('../style')
      </style>
   </head>
   <body>
      @yield('content')
      <footer>
         <script>
            $('.carousel').carousel({
                interval: 6000
            });
            $(document).ready(function() {
              $("#owl-example").owlCarousel({
                autoPlay : 5000
              });
             
            });
             $(function()
            {
                 $( "#q-search" ).autocomplete({
                  source: "{{route('autocomplete')}}",
                  minLength: 1,
                  select: function(event, ui) {
                          $('#q-search').val(ui.item.value); 
                  }
                });
                $('#q-search').data( "ui-autocomplete" )._renderItem = function( ul, item )
                {
                    var $li = $("<li style='width:800px;margin-left:10px;margin-bottom:5px'>"),
                        $img = $("<img style='width:8%'>");
                    $img.attr({
                      src: '{{asset("uploads")}}/' + item.avatar,
                      alt: item.value
                });
                $li.attr('data-value', item.value);
                $li.append("");
                $li.append($img).append(""+item.value);    
                return $li.appendTo(ul);
                
              };
            });
             $(".category a img").hover(function(){$(this).attr("src","{{asset('uploads')}}/caticonblack.png");}).mouseout(function(){$(this).attr("src","{{asset('uploads')}}/caticonred.png");});
         </script>
      </footer>
   </body>
</html>