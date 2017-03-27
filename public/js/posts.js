$( "#__posts").validate({
     rules: {
       name: {
         required: true
       },
       price: {
         required: true,
         number: true
       },
       description: {
         required: true
       },
       photo: {
         required: true
       }
       
     }
   });
$(".editPostFood").click(function(e){
  // e.preventDefault();
  $(".modeFood").modal('show');
  var id=$(this).parent().parent().find('#pid').val();
  var name=$(this).parent().parent().find('#pname').val();
  var price=$(this).parent().parent().find('#pprice').val();
  var description=$(this).parent().parent().find('#pdescription').val();
  var image=$(this).parent().parent().find('#pimage').val();
  $("#mname").val(name);
  $("#mprice").val(price);
  $("#mid").val(id);
  $("#mdescription").val(description);
  $("#image").val(name);
});
