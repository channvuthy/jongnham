@if(isset($background->body))
.main_body{
background-color:#{{$background->body}} !important;
}
.box_food {
   background-color:#{{$background->foodblock}} !important;
}
.footer{
   background-color:#{{$background->footer}} !important;
}
.header_middle{
   background-color:#{{$background->header}} !important;
}

@endif
@if(isset($backgroundimage))
<?php
 $backgroundArray=explode("||",$backgroundimage);
?>
.cat{
   background-image:url("{{URL('/')."/uploads/".(isset($backgroundArray[3])?$backgroundArray[3]:'')}}") !important;
}
.box_category {
   background-image:url("{{URL('/')."/uploads/".(isset($backgroundArray[4])?$backgroundArray[4]:'')}}") !important;
}
.specefic_category{
   background-image:url("{{URL('/')."/uploads/".(isset($backgroundArray[6])?$backgroundArray[6]:'')}}") !important;
}
@endif