<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="description" content="Jongnhams is the best website where you can find awesome restaurants in Phnom Penh.">
     <meta name="keywords" content="food in cambodia,restaurant in phnom penh">
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
     <meta name="author" content="Jongnhams">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/version2.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('js/jqueryRating/jRating.jquery.css')}}">
    <script src="{{asset('js/angular.min.js')}}"></script>

    
   
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.matchHeight.js')}}"></script>
    <script src="{{asset('js/jquery.mockjax.js')}}"></script>
    <script src="{{asset('js/jquery.form.js')}}"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script src="{{asset('js/tinymce.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>

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
    @include('version2.layouts.inc.jqeryrating')
    <script type="text/javascript">
    $(document).ready(function(){
      $('.basic').jRating({
        decimalLength :0,
        nbRates : 3,
        length : 5

        
      });
    });
  </script>
    </footer>
</body>
</html>